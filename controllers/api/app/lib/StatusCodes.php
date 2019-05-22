<?php

/**
 * Transaction status constants. Contains the statuses in which a transaction
 * can be in during processing.
 *
 * PHP VERSION 7.0
 *
 * @category  PAYMENT GATEWAY
 * @package   BenchMark
 * @copyright 2017 Gravity Limited Ltd
 * @license   Proprietory License
 * @link      http://gravity.co.ke
 */
class StatusCodes
{

    const STATUS_UNKNOWN = 103; //not matching
    const GENERAL_EXCEPTION_OCCURRED = 104; //not matching
    const INACTIVE_CLIENT = 105; //inactive Merchant
    const INACTIVE_SERVICE = 106;
    const CUSTOMER_MSISDN_MISSING = 109;
    const INVALID_CUSTOMER_MSISDN = 110;
    const CLIENT_AUTHENTICATED_SUCCESSFULLY = 131;
    const CLIENT_AUTHENTICATION_FAILED = 132;
    const PAYMENT_LOGGED_AS_FAILED = 138;
    const PAYMENT_POSTED_SUCCESSFULLY = 139;
    const PAYMENT_ACCEPTED = 140;
    const PAYMENT_REJECTED = 141;
	const PAYMENT_FAILED = 142;
    const CLIENT_USERNAME_NOT_PROVIDED = 163;
    const CLIENT_PASSWORD_NOT_PROVIDED = 164;
    const GENERIC_FAILURE_STATUS_CODE = 174;
    const PAYMENT_ACKNOWLEDGED_ACCEPTED = 183;
    const PUSH_STATUS_SUCCESS = 188;
    const PUSH_STATUS_FAILED_RETRY = 189;
    const PUSH_STATUS_FAILED_NO_RETRY = 190;
    const PARAMETERS_MISSING = 234;
    const PAYMENT_RECEIVED_SUCCESSFULLY = 310;
    const PAYMENT_SUCCESSFUL = 310;
    const PAYMENT_MARKED_FOR_REPROCESSING = 401;
    const PAYMENT_PUSHED_STATUS =1;
    
}
