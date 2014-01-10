<?php

/*
*
*   source : http://forums.steampowered.com/forums/showthread.php?t=1430511
*
*/

class SteamSignIn
{
    const STEAM_LOGIN = 'https://steamcommunity.com/openid/login';
    public static function genUrl($returnTo = false, $useAmp = true)
    {
        $returnTo = (!$returnTo) ? (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] : $returnTo;

        $params = array(
            'openid.ns'			=> 'http://specs.openid.net/auth/2.0',
            'openid.mode'		=> 'checkid_setup',
            'openid.return_to'	=> $returnTo,
            'openid.realm'		=> (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'],
            'openid.identity'	=> 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id'	=> 'http://specs.openid.net/auth/2.0/identifier_select',
        );

        $sep = ($useAmp) ? '&amp;' : '&';
        return self::STEAM_LOGIN . '?' . http_build_query($params, '', $sep);
    }

    public static function validate()
    {
        $params = array(
            'openid.assoc_handle'	=> $_GET['openid_assoc_handle'],
            'openid.signed'			=> $_GET['openid_signed'],
            'openid.sig'			=> $_GET['openid_sig'],
            'openid.ns'				=> 'http://specs.openid.net/auth/2.0',
        );

        $signed = explode(',', $_GET['openid_signed']);
        foreach($signed as $item)
        {
            $val = $_GET['openid_' . str_replace('.', '_', $item)];
            $params['openid.' . $item] = get_magic_quotes_gpc() ? stripslashes($val) : $val;
        }

        $params['openid.mode'] = 'check_authentication';

        $data =  http_build_query($params);
        $context = stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'header'  =>
                    "Accept-language: en\r\n".
                    "Content-type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data,
            ),
        ));

        $result = file_get_contents(self::STEAM_LOGIN, false, $context);

        preg_match("#^http://steamcommunity.com/openid/id/([0-9]{17,25})#", $_GET['openid_claimed_id'], $matches);
        $steamID64 = is_numeric($matches[1]) ? $matches[1] : 0;

        return preg_match("#is_valid\s*:\s*true#i", $result) == 1 ? $steamID64 : '';
    }
}