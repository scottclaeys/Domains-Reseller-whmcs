<?php

use domainsReseller\module\PdoWrapper;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
include_once dirname(__FILE__).DS.'PdoWrapper.php';
include_once dirname(__FILE__).DS.'class.api.php';

/**
 * FUNCTION RadWebHosting_getConfigArray().
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_getConfigArray()
{
    $configarray = [
        'FriendlyName' => [
            'Type'          => 'System',
            'Value'         => 'RAD WEB HOSTING',
        ],
        'Description' => [
            'Type'          => 'System',
            'Value'         => 'Offer a wide variety of TLD from your remote WHMCS.',
        ],
        'api_email' => [
            'FriendlyName'  => 'User Email',
            'Type'          => 'text',
            'Size'          => '40',
            'Description'   => 'Enter your email at RAD WEB HOSTING',
        ],
        'api_key' => [
            'FriendlyName'  => 'API Key',
            'Type'          => 'text',
            'Size'          => '40',
            'Description'   => 'Enter your RAD WEB HOSTING Domains API key',
        ],
    ];

    return $configarray;
}

/**
 * FUNCTION RadWebHosting_RegisterDomain()
 * Register Domain.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_RegisterDomain($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $requeststring = [
        'action'		              => 'RegisterDomain',
        'sld'			                => $params['sld'],
        'tld'			                => $params['tld'],
        'regperiod'		           => $params['regperiod'],
        'nameserver1'           => $params['ns1'],
        'nameserver2'           => $params['ns2'],
        'nameserver3'           => $params['ns3'],
        'nameserver4'           => $params['ns4'],
        'nameserver5'           => $params['ns5'],
        'dnsmanagement'		       => $params['dnsmanagement'] ? 1 : 0,
        'emailforwarding'	      => $params['emailforwarding'] ? 1 : 0,
        'idprotection'		        => $params['idprotection'] ? 1 : 0,
        'firstname'             => $params['firstname'],
        'lastname'		            => $params['lastname'],
        'companyname'           => $params['companyname'],
        'address1'		            => $params['address1'],
        'address2'		            => $params['address2'],
        'city'                  => $params['city'],
        'state'                 => $params['state'],
        'country'		             => $params['country'],
        'postcode'		            => $params['postcode'],
        'phonenumber'           => $params['phonenumber'],
        'fullphonenumber'       => $params['fullphonenumber'],
        'email'                 => $params['adminemail'],
        'adminfirstname'	       => $params['adminfirstname'],
        'adminlastname'		       => $params['adminlastname'],
        'admincompanyname'	     => $params['admincompanyname'],
        'adminaddress1'		       => $params['adminaddress1'],
        'adminaddress2'		       => $params['adminaddress2'],
        'admincity'		           => $params['admincity'],
        'adminstate'		          => $params['adminstate'],
        'admincountry'		        => $params['admincountry'],
        'adminpostcode'		       => $params['adminpostcode'],
        'adminphonenumber'	     => $params['adminphonenumber'],
        'adminfullphonenumber'  => $params['adminfullphonenumber'],
        'adminemail'		          => $params['adminemail'],
        'domainfields'          => base64_encode(serialize($params['additionalfields'])),
    ];

    if (isset($params['phonenumberformatted'])) {
        $requeststring['phonenumberformatted'] = $params['phonenumberformatted'];
    }
    if (isset($params['statecode'])) {
        $requeststring['statecode'] = $params['statecode'];
    }
    if (isset($params['adminfullstate'])) {
        $requeststring['adminfullstate'] = $params['adminfullstate'];
    }
    if (isset($params['countrycode'])) {
        $requeststring['countrycode'] = $params['countrycode'];
    }
    if (isset($params['fullstate'])) {
        $requeststring['fullstate'] = $params['fullstate'];
    }

    $result = $API->simpleCall('POST', $requeststring);

    return $API->getError() ? ['error' => $API->getError()] : 'success';
}

/**
 * FUNCTION RadWebHosting_TransferDomain()
 * Transfer Domain.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_TransferDomain($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $requeststring = [
        'action'		              => 'TransferDomain',
        'transfersecret'        => $params['transfersecret'],
        'sld'			                => $params['sld'],
        'tld'			                => $params['tld'],
        'regperiod'		           => $params['regperiod'],
        'nameserver1'           => $params['ns1'],
        'nameserver2'           => $params['ns2'],
        'nameserver3'           => $params['ns3'],
        'nameserver4'           => $params['ns4'],
        'nameserver5'           => $params['ns5'],
        'dnsmanagement'		       => $params['dnsmanagement'] ? 1 : 0,
        'emailforwarding'	      => $params['emailforwarding'] ? 1 : 0,
        'idprotection'		        => $params['idprotection'] ? 1 : 0,
        'firstname'             => $params['firstname'],
        'lastname'		            => $params['lastname'],
        'companyname'           => $params['companyname'],
        'address1'		            => $params['address1'],
        'address2'		            => $params['address2'],
        'city'                  => $params['city'],
        'state'                 => $params['state'],
        'country'		             => $params['country'],
        'postcode'		            => $params['postcode'],
        'phonenumber'           => $params['phonenumber'],
        'fullphonenumber'       => $params['fullphonenumber'],
        'email'                 => $params['email'],
        'adminfirstname'	       => $params['adminfirstname'],
        'adminlastname'		       => $params['adminlastname'],
        'admincompanyname'	     => $params['admincompanyname'],
        'adminaddress1'		       => $params['adminaddress1'],
        'adminaddress2'		       => $params['adminaddress2'],
        'admincity'		           => $params['admincity'],
        'adminstate'		          => $params['adminstate'],
        'admincountry'		        => $params['admincountry'],
        'adminpostcode'		       => $params['adminpostcode'],
        'adminphonenumber'	     => $params['adminphonenumber'],
        'adminfullphonenumber'  => $params['adminfullphonenumber'],
        'adminemail'		          => $params['adminemail'],
        'domainfields'          => base64_encode(serialize($params['additionalfields'])),
    ];

    if (isset($params['phonenumberformatted'])) {
        $requeststring['phonenumberformatted'] = $params['phonenumberformatted'];
    }
    if (isset($params['statecode'])) {
        $requeststring['statecode'] = $params['statecode'];
    }
    if (isset($params['adminfullstate'])) {
        $requeststring['adminfullstate'] = $params['adminfullstate'];
    }
    if (isset($params['countrycode'])) {
        $requeststring['countrycode'] = $params['countrycode'];
    }
    if (isset($params['fullstate'])) {
        $requeststring['fullstate'] = $params['fullstate'];
    }

    $API->simpleCall('POST', $requeststring);

    return $API->getError() ? ['error' => $API->getError()] : 'success';
}

/**
 * FUNCTION RadWebHosting_RenewDomain
 * Renew Domain.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_RenewDomain($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $API->simpleCall('POST', [
        'action'		   => 'RenewDomain',
        'sld'			     => $params['sld'],
        'tld'			     => $params['tld'],
        'regperiod'		=> $params['regperiod'],
    ]);

    return $API->getError() ? ['error' => $API->getError()] : 'success';
}

/**
 * FUNCTION RadWebHosting_getNameserver
 * Get name servers.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_GetNameservers($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		=> 'GetNameservers',
        'sld'			  => $params['sld'],
        'tld'			  => $params['tld'],
    ]);

    if ($data['result'] == 'success') {
        for ($i = 1; $i <= 5; $i++) {
            $return['ns'.$i] = $data['ns'.$i];
        }
    } else {
        return ['error'=>$API->getError()];
    }

    return $return;
}

/**
 * FUNCTION RadWebHosting_SaveNameservers
 * Save nameservers.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_SaveNameservers($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'                => 'SaveNameservers',
        'sld'                   => $params['sld'],
        'tld'                   => $params['tld'],
        'nameserver1'           => $params['ns1'],
        'nameserver2'           => $params['ns2'],
        'nameserver3'           => $params['ns3'],
        'nameserver4'           => $params['ns4'],
        'nameserver5'           => $params['ns5'],
    ]);

    if ($data['result'] == 'success') {
        return true;
    } else {
        return ['error'=>$API->getError()];
    }
}

/**
 * FUNCTION RadWebHosting_ReleaseDomain
 * Release Domain.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_ReleaseDomain($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'ReleaseDomain',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'newtag'            => $params['transfertag'],
        'transfertag'       => $params['transfertag'],
    ]);

    if ($data['result'] == 'success') {
        return true;
    } else {
        return ['error'=>$API->getError()];
    }
}

/**
 * FUNCTION RadWebHosting_getEPPCode
 * Get EPP Code.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_GetEPPCode($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		=> 'GetEPPCode',
        'sld'		   => $params['sld'],
        'tld'		   => $params['tld'],
    ]);

    if ($data['result'] == 'success') {
        if (is_array($data['eppcode'])) {
            $data['eppcode'] = reset($data['eppcode']);
        }

        return ['eppcode'=>$data['eppcode']];
    }

    return ['error'=>$API->getError()];
}

/**
 * FUNCTION RadWebHosting_getContactDetails
 * Get Contact Details.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_GetContactDetails($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		=> 'GetContactDetails',
        'sld'		   => $params['sld'],
        'tld'		   => $params['tld'],
    ]);

    if ($data['result'] == 'success') {
        unset($data['result']);
        $new = [];
        foreach ($data as $key=>$val) {
            foreach ($val as $k => $v) {
                $new[$key][str_replace('_', ' ', $k)] = $v;
            }
        }

        return $new;
    } else {
        return ['error'=>$API->getError()];
    }
}

/**
 * FUNCTION RadWebHosting_SaveContactDetails
 * Save Contact Details.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_SaveContactDetails($params)
{
    $new = [];
    foreach ($params['contactdetails'] as $key=>$val) {
        foreach ($val as $k => $v) {
            $new[$key][str_replace(' ', '_', $k)] = $v;
        }
    }

    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $te = [
        'action'		          => 'SaveContactDetails',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'contactdetails'    => $new,
    ];

    $data = $API->simpleCall('POST', $te);

    if ($data['result'] == 'success') {
        unset($data['result']);

        return $data;
    } else {
        return ['error'=>$API->getError()];
    }
}

/**
 * FUNCTION RadWebHosting_GetDomainFields
 * Get Additional Domain Fields.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_GetDomainFields()
{
    global $additionaldomainfields;
    $query = PdoWrapper::query("SELECT `setting`,`value` FROM `tblregistrars` WHERE `registrar`='RadWebHosting'");
    $params = [];

    while ($r = PdoWrapper::fetchAssoc($query)) {
        $params[$r['setting']] = decrypt($r['value']);
    }

    if (empty($params)) {
        return false;
    }

    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $vars = [
        'action' => 'GetDomainFields',
    ];
    $data = $API->simpleCall('POST', $vars);
    if (is_array($data)) {
        $merge = array_merge($additionaldomainfields, $data);

        return $merge;
    }
}

/**
 * FUNCTION RadWebHosting_getRegistrarLock
 * Get Lock Status.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_GetRegistrarLock($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		=> 'domaingetlockingstatus',
        'sld'		   => $params['sld'],
        'tld'		   => $params['tld'],
    ]);

    if ($data['result'] == 'success') {
        if ($data['lockstatus'] == 'Unknown') {
            return '';
        }

        return $data['lockstatus'];
    } else {
        return ['error'=>$API->getError()];
    }
}

/**
 * FUNCTION RadWebHosting_SaveRegistrarLock
 * Update Lock Status.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_SaveRegistrarLock($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'domainupdatelockingstatus',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'lockenabled'       => $params['lockenabled'],
    ]);

    if ($data['result'] == 'success') {
        return true;
    } elseif ($data['result'] == 'empty') {
        return;
    } else {
        return ['error'=>$API->getError()];
    }
}

/**
 * FUNCTION RadWebHosting_GetDNS
 * Get DNS Records.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_GetDNS($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'GetDNS',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'regtype'           => $params['regtype'],
    ]);

    if ($data['result'] == 'success') {
        unset($data['result']);

        return $data;
    } else {
        return [
            'error' => $API->getError(),
        ];
    }
}

/**
 * FUNCTION RadWebHosting_SaveDNS
 * Save DNS Records.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_SaveDNS($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'SaveDNS',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'regtype'           => $params['regtype'],
        'dnsrecords'        => base64_encode(serialize($params['dnsrecords'])),
    ]);

    if ($data['result'] == 'success') {
        return 'success';
    } else {
        return [
            'error' => $API->getError(),
        ];
    }
}

/**
 * FUNCTION RadWebHosting_RegisterNameserver
 * Register Name Server.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_RegisterNameserver($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'RegisterNameserver',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'nameserver'        => $params['nameserver'],
        'ipaddress'         => $params['ipaddress'],
        'regtype'           => $params['regtype'],
    ]);

    if ($data['result'] == 'success') {
        return 'success';
    } else {
        return [
            'error' => $API->getError(),
        ];
    }
}

/**
 * FUNCTION RadWebHosting_ModifyNameserver
 * Update Name Server.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_ModifyNameserver($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'ModifyNameserver',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'nameserver'        => $params['nameserver'],
        'currentipaddress'  => $params['currentipaddress'],
        'newipaddress'      => $params['newipaddress'],
        'regtype'           => $params['regtype'],
    ]);

    if ($data['result'] == 'success') {
        return 'success';
    } else {
        return [
            'error' => $API->getError(),
        ];
    }
}

/**
 * FUNCTION RadWebHosting_DeleteNameserver
 * Delete Name Server.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_DeleteNameserver($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'DeleteNameserver',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'nameserver'        => $params['nameserver'],
        'regtype'           => $params['regtype'],
    ]);

    if ($data['result'] == 'success') {
        return 'success';
    } else {
        return [
            'error' => $API->getError(),
        ];
    }
}

/**
 * FUNCTION RadWebHosting_RequestDelete
 * Delete Domain.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_RequestDelete($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'RequestDelete',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'regtype'           => $params['regtype'],
    ]);
    $values = [];
    if ($data['result'] == 'success') {
        return 'success';
    } else {
        $values['error'] = $API->getError();
    }

    return $values;
}

/**
 * FUNCTION RadWebHosting_TransferSync
 * Synchronize transfer domain.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_TransferSync($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'TransferSync',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'domain'            => $params['sld'].'.'.$params['tld'],
    ]);
    $values = [];
    if ($data['result'] == 'success') {
        unset($data['result']);

        return $data;
    } else {
        $values['error'] = $API->getError();
    }

    return $values;
}

/**
 * FUNCTION RadWebHosting_Sync
 * Synchronize Registered Domains.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_Sync($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'Sync',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'domain'            => $params['sld'].'.'.$params['tld'],
    ]);
    $values = [];
    if ($data['result'] == 'success') {
        unset($data['result']);
        if ($data['status'] == 'Active') {
            $values['active'] = true;
        } else {
            if (strtotime(date('Ymd')) <= strtotime($data['expirydate'])) {
                $values['expirydate'] = $data['expirydate'];
                $values['active'] = true;
            } else {
                $values['expirydate'] = $data['expirydate'];
                $values['expired'] = true;
            }
        }

        return $values;
    } else {
        $values['error'] = $API->getError();
    }

    return $values;
}

/**
 * FUNCTION RadWebHosting_GetEmailForwarding
 * Get list of emails aliases.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_GetEmailForwarding($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'GetEmailForwarding',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'regtype'           => $params['regtype'],
    ]);
    if ($data['result'] == 'success') {
        unset($data['result']);

        return $data;
    }
}

/**
 * FUNCTION RadWebHosting_SaveEmailForwarding
 * Save list of emails aliases.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_SaveEmailForwarding($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'SaveEmailForwarding',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'regperiod'         => $params['regperiod'],
        'regtype'           => $params['regtype'],
        'prefix'            => base64_encode(serialize($params['prefix'])),
        'forwardto'         => base64_encode(serialize($params['forwardto'])),
    ]);
    if ($data['result'] == 'success') {
        return $data;
    } else {
        return [
            'error' => $API->getError(),
        ];
    }
}

/**
 * FUNCTION RadWebHosting_IDProtectToggle
 * This function is called when the ID Protection setting is toggled on or off.
 *
 * @param array $params
 *
 * @return array $return
 */
function RadWebHosting_IDProtectToggle($params)
{
    $API = new RadWebHosting_API($params['api_email'], $params['api_key']);
    $data = $API->simpleCall('POST', [
        'action'		          => 'IDProtectToggle',
        'sld'		             => $params['sld'],
        'tld'		             => $params['tld'],
        'domainname'        => $params['domainname'],
        'regperiod'         => $params['regperiod'],
        'protectenable'     => $params['protectenable'],
    ]);
    if ($data['result'] == 'success') {
        return $data;
    } else {
        return [
            'error' => $API->getError(),
        ];
    }
}
