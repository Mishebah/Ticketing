<?php
//namespace App\src\Authenticator
/**
 * This file holds the Authenticator class used to authenticate the API Users.
 *
 * PHP VERSION 7.0
 *
 * @category  PAYMENT GATEWAY
 * @package   BenchMark
 * @copyright 2017 Gravity Limited Ltd
 * @license   Proprietory License
 * @link      http://gravity.co.ke
 */
class Authenticator
{

    /**
     * Log class instance.
     *
     * @var object
     */
    private $log;
	

    /**
     * TAT turn around time for functions or loops.
     * Used for benchmarking
     * @var object
     */
    private $tat;
	
	private $CONF;

    /**
     * Class constuctor.
     */
    public function __construct() {
        $this->log = new \AppLogger();
        $this->tat = new \BenchMark(session_id());
		
    }

    /**
     * This function is used as the main authenticator with all the procedures
     * required. The function returns the following status codes and
     * descriptions.
     * <ul>
     * <li>131 | Authentication Successful => All parameters are ok and the user
     * is active</li>
     * <li>132 | Authentication failed => User cannot access API, only UI</li>
     * <li>132 | Authentication failed => User is inactive or user api_secret is
     * inactive</li>
     * <li>132 | Authentication failed => api_key does not exist</li>
     * <li>132 | Authentication failed => Internal server error</li>
     * <li>132 | Authentication failed => Credential payload is null or does not
     * exist</li>
     * <li>163 | api_key not provided => The api_key is not provided in the
     * payload</li>
     * <li>164 | api_secret not provided => The api_secret is not provided in the
     * payload</li>
     * <li>105 | INACTIVE_CLIENT => The client is inactive</li>
     * </ul>
     *
     * @param array $credentials array carrying the api_key and api_secret
     *
     * @return mixed Array containing the authentication status and additional
     *               information.
     */
    public function authenticate($credentials) {
        $this->tat->start(BenchMark::FUNCTION_LEVEL, __METHOD__);
        try {
            $logCredentials = $credentials;
            $logCredentials['x-api-secret'] = "****************";
            $this->log->debugLog(\Config::DEBUG, -1,
                "Credentials used for authentication:"
                . $this->log->printArray($logCredentials));
            $passwdStatusID = 1;
            $canAccessUI = 0;
            $active = 1;
            $dblink = null;
            // Verify to see that all the credentials params are presient
            if ($credentials != null) {
                // api_key of invoking user
                $api_key = $credentials['x-api-key'];
                // The api_secret of invoking user
                $api_secret = $credentials['x-api-secret'];
                //The client code of the client being represented

                if ($api_key != null && $api_secret != null) {
                    $authStatus = array();

                    $dblink = new MySQL(Config::HOST, Config::USER,
                        Config::PASSWORD, Config::DATABASE, Config::PORT);
                    try {

                        $response = array();

                        /*
                         * Try to use stronger but system-specific hashes, with
                         * a possible fallback to the weaker portable hashes.
                         */
                        $hasher = new \PasswordHash(8, false);

                        $query = "SELECT api_key, api_secret, c.clientID, "
                            . "c.clientCode, apiUserID, "
                            . " u.active "
                            . "FROM apiUsers u INNER JOIN clients c "
                            . "ON c.clientID = u.clientID WHERE api_key = ? ";

                        $params = array("s", $api_key);

                        $this->log->sequelLog(Config::DEBUG, -1,
                            "Query to fetch user key and password: "
                            . CoreUtils::formatQueryForLogging($query, $params));
                        // Result from the executed query
                        $result = DatabaseUtilities::executeQuery($dblink->mysqli,
                                $query, $params);

                        if (count($result) == 1) {
						
                            $resultDebug = $result;
                            if (!empty($resultDebug)) {
                                $resultDebug[0]['api_secret'] = "==Sorry, not Viewable==";
                            }
                            $this->log->debugLog(Config::DEBUG, -1,
                                "Result from query: "
                                . $this->log->printArray($resultDebug));

            

                            if ($result[0]['active'] != $passwdStatusID) {
                                $response = [
                                    "status" => StatusCodes::CLIENT_AUTHENTICATION_FAILED,
                                    "description" => "User with "
                                    . "api_key '" . $api_key
                                    . "' has an inactive api_secret"];
                                $this->log->errorLog(Config::ERROR, -1,
                                    "Access denied -> User with api_key '"
                                    . $api_key . "' has an inactive api_secret");

                                $this->tat->logTAT(BenchMark::FUNCTION_LEVEL,
                                    __METHOD__);
                                return $response;
                            }
							
                            //Fetch the stored api_secret from the DB
                            $storedPass = $result[0]['api_secret'];
                            $check = $hasher->CheckPassword($api_secret,
                                $storedPass);
							$check = true;
                            if ($check) {
                                $response['clientCode'] = $result[0]['clientCode'];
                                $response['clientID'] = $result[0]['clientID'];
                                $response['userID'] = $result[0]['apiUserID'];
								$statusResponse = [
                                    "status" => StatusCodes::CLIENT_AUTHENTICATED_SUCCESSFULLY,
                                    "description" =>'Successful authentication',
									  ];
                                $response = array_merge($response,$statusResponse);
                                $this->log->infoLog(Config::INFO, -1,
                                    "User " . $credentials['x-api-key']
                                    . " with userID: " . $response['userID']
                                    . " has been authenticated. User belongs to: "
                                    . $result[0]['clientCode']);

                            } else {
                                $response = array(
                                    "status" => StatusCodes::CLIENT_AUTHENTICATION_FAILED,
                                    "description" => "Provided user details do not match ");

                                $this->log->errorLog(Config::ERROR, -1,
                                    "User " . $credentials['x-api-key']
                                    . " has failed authentication. ");
                            }
                        } else {
                            $response = array("status" => StatusCodes::CLIENT_AUTHENTICATION_FAILED,
                                "description" => "User with the provided "
                                . "api_key does not exist");
                            $this->log->errorLog(Config::ERROR, -1,
                                "User " . $credentials['x-api-key']
                                . " Does not exist in the system. Returning: "
                                . $this->log->printArray($response));
                        }
                    } catch (SQLException $e) {

                        $this->log->errorLog(Config::ERROR, -1,
                            "Mysql Error while authenticating: " . $e->getMessage());

                        $response = array("status" => StatusCodes::CLIENT_AUTHENTICATION_FAILED,
                            "description" => "Internal server Error. " . "Failed authentication");
                    } catch (Exception $e) {

                        $this->log->errorLog(Config::ERROR, -1,
                            "Error while authenticating: " . $e->getMessage());

                        $response = array("status" => StatusCodes::CLIENT_AUTHENTICATION_FAILED,
                            "description" => "Internal server Error. " . "Failed authentication");
                    }

                    $this->tat->logTAT(BenchMark::FUNCTION_LEVEL, __METHOD__);
                    return $response;
                } else {
                    $this->log->errorLog(Config::ERROR, -1,
                        "api_key or api_secret not supplied. " . "Authentication not possible.");

                    /*
                     * Authentication cannot be performed so exit function with
                     * appropriate status code.
                     */
                    if ($api_key == null || empty($api_key)) {
                        $authStatus['status'] = StatusCodes::CLIENT_AUTHENTICATION_FAILED;
                        $authStatus['description'] = "api_key not "
                            . "supplied. Authentication not possible, exiting.";
                    } elseif ($api_secret == null || empty($api_secret)) {
                        $authStatus['status'] = StatusCodes::CLIENT_AUTHENTICATION_FAILED;
                        $authStatus['description'] = "api_secret not "
                            . "supplied. Authentication not possible.";
                    }

                    // Formulating the response
                    $response = $authStatus;

                    $this->log->errorLog(Config::ERROR, -1,
                        "Authentication not possible."
                        . $this->log->printArray($response["statusInfo"]));

                    $this->tat->logTAT(BenchMark::FUNCTION_LEVEL, __METHOD__);
                    return $response;
                }
            } else {
                $authStatus['status'] = StatusCodes::CLIENT_AUTHENTICATION_FAILED;
                $authStatus['description'] = "Credentials payload "
                    . "section is missing or null. Authentication not possible";

                // Formulate the response
                $response = $authStatus;

                $this->log->errorLog(Config::ERROR, -1,
                    "Credentials payload missing or null. "
                    . "Authentication not possible. Response: "
                    . $this->log->printArray($response["statusInfo"]));

                $this->tat->logTAT(BenchMark::FUNCTION_LEVEL, __METHOD__);
                return $response;
            }
        } catch (SQLException $e) {

            $this->log->errorLog(Config::ERROR, -1,
                "Error while authenticating: " . $e->getMessage());

            $response = array("status" => StatusCodes::GENERIC_FAILURE_STATUS_CODE,
                "description" => "Internal server Error. " . "Failed authentication");
        } catch (Exception $e) {

            $this->log->errorLog(Config::ERROR, -1,
                "Error while authenticating: " . $e->getMessage());

            $response = array("status" => StatusCodes::GENERIC_FAILURE_STATUS_CODE,
                "description" => "Internal server Error. " . "Failed authentication");
        }
        $this->log->errorLog(Config::ERROR, -1,
            "Authentication failed authStatus to be returned: " . $this->log->printArray($response["statusInfo"]));

        $this->tat->logTAT(BenchMark::FUNCTION_LEVEL, __METHOD__);
        return $response;
    }

}
