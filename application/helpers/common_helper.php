
<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


if (!function_exists('hitCurlRequest')) {
	function hitCurlRequest($payload) {

        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_PORT => "3001",
        CURLOPT_URL => "http://3.120.159.133:3001/api/admin/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => [
            "Authorization: Basic YWRtaW5Mb2dpbjphc2ltOTI1NzhAZ21haWwuY29t",
            "Content-Type: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);

        return $response;
	}
} //end num


if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $timezone, $full = false) {
        $CI = &get_instance();
        $datetime2 = date("Y-m-d g:i:s A");
        $timezone = $timezone;
        $date = date_create($datetime2);
        date_timezone_set($date, timezone_open($timezone));
        $now1 = date_format($date, 'Y-m-d g:i:s A');
        $now = new DateTime($now1);
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
} //end

if(!function_exists('getCountry')){
    function getCountry(){

        $countries = array (
            0 => 
            array (
            'name' => 'Andorra',
            'code' => 'AD',
            ),
            1 => 
            array (
            'name' => 'United Arab Emirates',
            'code' => 'AE',
            ),
            2 => 
            array (
            'name' => 'Afghanistan',
            'code' => 'AF',
            ),
            3 => 
            array (
            'name' => 'Antigua and Barbuda',
            'code' => 'AG',
            ),
            4 => 
            array (
            'name' => 'Anguilla',
            'code' => 'AI',
            ),
            5 => 
            array (
            'name' => 'Albania',
            'code' => 'AL',
            ),
            6 => 
            array (
            'name' => 'Armenia',
            'code' => 'AM',
            ),
            7 => 
            array (
            'name' => 'Netherlands Antilles',
            'code' => 'AN',
            ),
            8 => 
            array (
            'name' => 'Angola',
            'code' => 'AO',
            ),
            9 => 
            array (
            'name' => 'Antarctica',
            'code' => 'AQ',
            ),
            10 => 
            array (
            'name' => 'Argentina',
            'code' => 'AR',
            ),
            11 => 
            array (
            'name' => 'American Samoa',
            'code' => 'AS',
            ),
            12 => 
            array (
            'name' => 'Austria',
            'code' => 'AT',
            ),
            13 => 
            array (
            'name' => 'Australia',
            'code' => 'AU',
            ),
            14 => 
            array (
            'name' => 'Aruba',
            'code' => 'AW',
            ),
            15 => 
            array (
            'name' => 'Azerbaijan',
            'code' => 'AZ',
            ),
            16 => 
            array (
            'name' => 'Bosnia and Herzegovina',
            'code' => 'BA',
            ),
            17 => 
            array (
            'name' => 'Barbados',
            'code' => 'BB',
            ),
            18 => 
            array (
            'name' => 'Bangladesh',
            'code' => 'BD',
            ),
            19 => 
            array (
            'name' => 'Belgium',
            'code' => 'BE',
            ),
            20 => 
            array (
            'name' => 'Burkina Faso',
            'code' => 'BF',
            ),
            21 => 
            array (
            'name' => 'Bulgaria',
            'code' => 'BG',
            ),
            22 => 
            array (
            'name' => 'Bahrain',
            'code' => 'BH',
            ),
            23 => 
            array (
            'name' => 'Burundi',
            'code' => 'BI',
            ),
            24 => 
            array (
            'name' => 'Benin',
            'code' => 'BJ',
            ),
            25 => 
            array (
            'name' => 'Bermuda',
            'code' => 'BM',
            ),
            26 => 
            array (
            'name' => 'Brunei Darussalam',
            'code' => 'BN',
            ),
            27 => 
            array (
            'name' => 'Bolivia',
            'code' => 'BO',
            ),
            28 => 
            array (
            'name' => 'Brazil',
            'code' => 'BR',
            ),
            29 => 
            array (
            'name' => 'Bahamas',
            'code' => 'BS',
            ),
            30 => 
            array (
            'name' => 'Bhutan',
            'code' => 'BT',
            ),
            31 => 
            array (
            'name' => 'Bouvet Island',
            'code' => 'BV',
            ),
            32 => 
            array (
            'name' => 'Botswana',
            'code' => 'BW',
            ),
            33 => 
            array (
            'name' => 'Belarus',
            'code' => 'BY',
            ),
            34 => 
            array (
            'name' => 'Belize',
            'code' => 'BZ',
            ),
            35 => 
            array (
            'name' => 'Canada',
            'code' => 'CA',
            ),
            36 => 
            array (
            'name' => 'Cocos (Keeling) Islands',
            'code' => 'CC',
            ),
            37 => 
            array (
            'name' => 'Congo, the Democratic Republic of the',
            'code' => 'CD',
            ),
            38 => 
            array (
            'name' => 'Central African Republic',
            'code' => 'CF',
            ),
            39 => 
            array (
            'name' => 'Congo',
            'code' => 'CG',
            ),
            40 => 
            array (
            'name' => 'Switzerland',
            'code' => 'CH',
            ),
            41 => 
            array (
            'name' => 'Cote D\'Ivoire',
            'code' => 'CI',
            ),
            42 => 
            array (
            'name' => 'Cook Islands',
            'code' => 'CK',
            ),
            43 => 
            array (
            'name' => 'Chile',
            'code' => 'CL',
            ),
            44 => 
            array (
            'name' => 'Cameroon',
            'code' => 'CM',
            ),
            45 => 
            array (
            'name' => 'China',
            'code' => 'CN',
            ),
            46 => 
            array (
            'name' => 'Colombia',
            'code' => 'CO',
            ),
            47 => 
            array (
            'name' => 'Costa Rica',
            'code' => 'CR',
            ),
            48 => 
            array (
            'name' => 'Cuba, Republic of',
            'code' => 'CU',
            ),
            49 => 
            array (
            'name' => 'Cape Verde',
            'code' => 'CV',
            ),
            50 => 
            array (
            'name' => 'Curacao',
            'code' => 'CW',
            ),
            51 => 
            array (
            'name' => 'Christmas Island',
            'code' => 'CX',
            ),
            52 => 
            array (
            'name' => 'Cyprus',
            'code' => 'CY',
            ),
            53 => 
            array (
            'name' => 'Czech Republic',
            'code' => 'CZ',
            ),
            54 => 
            array (
            'name' => 'Germany',
            'code' => 'DE',
            ),
            55 => 
            array (
            'name' => 'Djibouti',
            'code' => 'DJ',
            ),
            56 => 
            array (
            'name' => 'Denmark',
            'code' => 'DK',
            ),
            57 => 
            array (
            'name' => 'Dominica',
            'code' => 'DM',
            ),
            58 => 
            array (
            'name' => 'Dominican Republic',
            'code' => 'DO',
            ),
            59 => 
            array (
            'name' => 'Algeria',
            'code' => 'DZ',
            ),
            60 => 
            array (
            'name' => 'Ecuador',
            'code' => 'EC',
            ),
            61 => 
            array (
            'name' => 'Estonia',
            'code' => 'EE',
            ),
            62 => 
            array (
            'name' => 'Egypt',
            'code' => 'EG',
            ),
            63 => 
            array (
            'name' => 'Western Sahara',
            'code' => 'EH',
            ),
            64 => 
            array (
            'name' => 'Eritrea',
            'code' => 'ER',
            ),
            65 => 
            array (
            'name' => 'Spain',
            'code' => 'ES',
            ),
            66 => 
            array (
            'name' => 'Ethiopia',
            'code' => 'ET',
            ),
            67 => 
            array (
            'name' => 'Finland',
            'code' => 'FI',
            ),
            68 => 
            array (
            'name' => 'Fiji',
            'code' => 'FJ',
            ),
            69 => 
            array (
            'name' => 'Falkland Islands (Malvinas)',
            'code' => 'FK',
            ),
            70 => 
            array (
            'name' => 'Micronesia, Federated States of',
            'code' => 'FM',
            ),
            71 => 
            array (
            'name' => 'Faroe Islands',
            'code' => 'FO',
            ),
            72 => 
            array (
            'name' => 'France',
            'code' => 'FR',
            ),
            73 => 
            array (
            'name' => 'Gabon',
            'code' => 'GA',
            ),
            74 => 
            array (
            'name' => 'United Kingdom',
            'code' => 'GB',
            ),
            75 => 
            array (
            'name' => 'Grenada',
            'code' => 'GD',
            ),
            76 => 
            array (
            'name' => 'Georgia',
            'code' => 'GE',
            ),
            77 => 
            array (
            'name' => 'French Guiana',
            'code' => 'GF',
            ),
            78 => 
            array (
            'name' => 'Guernsey',
            'code' => 'GG',
            ),
            79 => 
            array (
            'name' => 'Ghana',
            'code' => 'GH',
            ),
            80 => 
            array (
            'name' => 'Gibraltar',
            'code' => 'GI',
            ),
            81 => 
            array (
            'name' => 'Greenland',
            'code' => 'GL',
            ),
            82 => 
            array (
            'name' => 'Gambia',
            'code' => 'GM',
            ),
            83 => 
            array (
            'name' => 'Guinea',
            'code' => 'GN',
            ),
            84 => 
            array (
            'name' => 'Guadeloupe',
            'code' => 'GP',
            ),
            85 => 
            array (
            'name' => 'Equatorial Guinea',
            'code' => 'GQ',
            ),
            86 => 
            array (
            'name' => 'Greece',
            'code' => 'GR',
            ),
            87 => 
            array (
            'name' => 'South Georgia and the South Sandwich Islands',
            'code' => 'GS',
            ),
            88 => 
            array (
            'name' => 'Guatemala',
            'code' => 'GT',
            ),
            89 => 
            array (
            'name' => 'Guam',
            'code' => 'GU',
            ),
            90 => 
            array (
            'name' => 'Guinea-Bissau',
            'code' => 'GW',
            ),
            91 => 
            array (
            'name' => 'Guyana',
            'code' => 'GY',
            ),
            92 => 
            array (
            'name' => 'Hong Kong',
            'code' => 'HK',
            ),
            93 => 
            array (
            'name' => 'Heard Island and Mcdonald Islands',
            'code' => 'HM',
            ),
            94 => 
            array (
            'name' => 'Honduras',
            'code' => 'HN',
            ),
            95 => 
            array (
            'name' => 'Croatia',
            'code' => 'HR',
            ),
            96 => 
            array (
            'name' => 'Haiti',
            'code' => 'HT',
            ),
            97 => 
            array (
            'name' => 'Hungary',
            'code' => 'HU',
            ),
            98 => 
            array (
            'name' => 'Indonesia',
            'code' => 'ID',
            ),
            99 => 
            array (
            'name' => 'Ireland',
            'code' => 'IE',
            ),
            100 => 
            array (
            'name' => 'Israel',
            'code' => 'IL',
            ),
            101 => 
            array (
            'name' => 'Isle of Man',
            'code' => 'IM',
            ),
            102 => 
            array (
            'name' => 'India',
            'code' => 'IN',
            ),
            103 => 
            array (
            'name' => 'British Indian Ocean Territory',
            'code' => 'IO',
            ),
            104 => 
            array (
            'name' => 'Iraq',
            'code' => 'IQ',
            ),
            105 => 
            array (
            'name' => 'Iran, Islamic Republic of',
            'code' => 'IR',
            ),
            106 => 
            array (
            'name' => 'Iceland',
            'code' => 'IS',
            ),
            107 => 
            array (
            'name' => 'Italy',
            'code' => 'IT',
            ),
            108 => 
            array (
            'name' => 'Jersey',
            'code' => 'JE',
            ),
            109 => 
            array (
            'name' => 'Jamaica',
            'code' => 'JM',
            ),
            110 => 
            array (
            'name' => 'Jordan',
            'code' => 'JO',
            ),
            111 => 
            array (
            'name' => 'Japan',
            'code' => 'JP',
            ),
            112 => 
            array (
            'name' => 'Kenya',
            'code' => 'KE',
            ),
            113 => 
            array (
            'name' => 'Kyrgyzstan',
            'code' => 'KG',
            ),
            114 => 
            array (
            'name' => 'Cambodia',
            'code' => 'KH',
            ),
            115 => 
            array (
            'name' => 'Kiribati',
            'code' => 'KI',
            ),
            116 => 
            array (
            'name' => 'Comoros',
            'code' => 'KM',
            ),
            117 => 
            array (
            'name' => 'Saint Kitts and Nevis',
            'code' => 'KN',
            ),
            118 => 
            array (
            'name' => 'Korea, Democratic People\'s Republic of',
            'code' => 'KP',
            ),
            119 => 
            array (
            'name' => 'Korea, Republic of',
            'code' => 'KR',
            ),
            120 => 
            array (
            'name' => 'Kuwait',
            'code' => 'KW',
            ),
            121 => 
            array (
            'name' => 'Cayman Islands',
            'code' => 'KY',
            ),
            122 => 
            array (
            'name' => 'Kazakhstan',
            'code' => 'KZ',
            ),
            123 => 
            array (
            'name' => 'Lao People\'s Democratic Republic',
            'code' => 'LA',
            ),
            124 => 
            array (
            'name' => 'Lebanon',
            'code' => 'LB',
            ),
            125 => 
            array (
            'name' => 'Saint Lucia',
            'code' => 'LC',
            ),
            126 => 
            array (
            'name' => 'Liechtenstein',
            'code' => 'LI',
            ),
            127 => 
            array (
            'name' => 'Sri Lanka',
            'code' => 'LK',
            ),
            128 => 
            array (
            'name' => 'Liberia',
            'code' => 'LR',
            ),
            129 => 
            array (
            'name' => 'Lesotho',
            'code' => 'LS',
            ),
            130 => 
            array (
            'name' => 'Lithuania',
            'code' => 'LT',
            ),
            131 => 
            array (
            'name' => 'Luxembourg',
            'code' => 'LU',
            ),
            132 => 
            array (
            'name' => 'Latvia',
            'code' => 'LV',
            ),
            133 => 
            array (
            'name' => 'Libyan Arab Jamahiriya',
            'code' => 'LY',
            ),
            134 => 
            array (
            'name' => 'Morocco',
            'code' => 'MA',
            ),
            135 => 
            array (
            'name' => 'Monaco',
            'code' => 'MC',
            ),
            136 => 
            array (
            'name' => 'Moldova, Republic of',
            'code' => 'MD',
            ),
            137 => 
            array (
            'name' => 'Montenegro',
            'code' => 'ME',
            ),
            138 => 
            array (
            'name' => 'Saint Martin',
            'code' => 'MF',
            ),
            139 => 
            array (
            'name' => 'Madagascar',
            'code' => 'MG',
            ),
            140 => 
            array (
            'name' => 'Marshall Islands',
            'code' => 'MH',
            ),
            141 => 
            array (
            'name' => 'North Macedonia, Republic of',
            'code' => 'MK',
            ),
            142 => 
            array (
            'name' => 'Mali',
            'code' => 'ML',
            ),
            143 => 
            array (
            'name' => 'Myanmar',
            'code' => 'MM',
            ),
            144 => 
            array (
            'name' => 'Mongolia',
            'code' => 'MN',
            ),
            145 => 
            array (
            'name' => 'Macao',
            'code' => 'MO',
            ),
            146 => 
            array (
            'name' => 'Northern Mariana Islands',
            'code' => 'MP',
            ),
            147 => 
            array (
            'name' => 'Martinique',
            'code' => 'MQ',
            ),
            148 => 
            array (
            'name' => 'Mauritania',
            'code' => 'MR',
            ),
            149 => 
            array (
            'name' => 'Montserrat',
            'code' => 'MS',
            ),
            150 => 
            array (
            'name' => 'Malta',
            'code' => 'MT',
            ),
            151 => 
            array (
            'name' => 'Mauritius',
            'code' => 'MU',
            ),
            152 => 
            array (
            'name' => 'Maldives',
            'code' => 'MV',
            ),
            153 => 
            array (
            'name' => 'Malawi',
            'code' => 'MW',
            ),
            154 => 
            array (
            'name' => 'Mexico',
            'code' => 'MX',
            ),
            155 => 
            array (
            'name' => 'Malaysia',
            'code' => 'MY',
            ),
            156 => 
            array (
            'name' => 'Mozambique',
            'code' => 'MZ',
            ),
            157 => 
            array (
            'name' => 'Namibia',
            'code' => 'NA',
            ),
            158 => 
            array (
            'name' => 'New Caledonia',
            'code' => 'NC',
            ),
            159 => 
            array (
            'name' => 'Niger',
            'code' => 'NE',
            ),
            160 => 
            array (
            'name' => 'Norfolk Island',
            'code' => 'NF',
            ),
            161 => 
            array (
            'name' => 'Nigeria',
            'code' => 'NG',
            ),
            162 => 
            array (
            'name' => 'Nicaragua',
            'code' => 'NI',
            ),
            163 => 
            array (
            'name' => 'Netherlands',
            'code' => 'NL',
            ),
            164 => 
            array (
            'name' => 'Norway',
            'code' => 'NO',
            ),
            165 => 
            array (
            'name' => 'Nepal',
            'code' => 'NP',
            ),
            166 => 
            array (
            'name' => 'Nauru',
            'code' => 'NR',
            ),
            167 => 
            array (
            'name' => 'Niue',
            'code' => 'NU',
            ),
            168 => 
            array (
            'name' => 'New Zealand',
            'code' => 'NZ',
            ),
            169 => 
            array (
            'name' => 'Oman',
            'code' => 'OM',
            ),
            170 => 
            array (
            'name' => 'Panama',
            'code' => 'PA',
            ),
            171 => 
            array (
            'name' => 'Peru',
            'code' => 'PE',
            ),
            172 => 
            array (
            'name' => 'French Polynesia',
            'code' => 'PF',
            ),
            173 => 
            array (
            'name' => 'Papua New Guinea',
            'code' => 'PG',
            ),
            174 => 
            array (
            'name' => 'Philippines',
            'code' => 'PH',
            ),
            175 => 
            array (
            'name' => 'Pakistan',
            'code' => 'PK',
            ),
            176 => 
            array (
            'name' => 'Poland',
            'code' => 'PL',
            ),
            177 => 
            array (
            'name' => 'Saint Pierre and Miquelon',
            'code' => 'PM',
            ),
            178 => 
            array (
            'name' => 'Pitcairn',
            'code' => 'PN',
            ),
            179 => 
            array (
            'name' => 'Puerto Rico',
            'code' => 'PR',
            ),
            180 => 
            array (
            'name' => 'Palestinian Territory, Occupied',
            'code' => 'PS',
            ),
            181 => 
            array (
            'name' => 'Portugal',
            'code' => 'PT',
            ),
            182 => 
            array (
            'name' => 'Palau',
            'code' => 'PW',
            ),
            183 => 
            array (
            'name' => 'Paraguay',
            'code' => 'PY',
            ),
            184 => 
            array (
            'name' => 'Qatar',
            'code' => 'QA',
            ),
            185 => 
            array (
            'name' => 'Reunion',
            'code' => 'RE',
            ),
            186 => 
            array (
            'name' => 'Romania',
            'code' => 'RO',
            ),
            187 => 
            array (
            'name' => 'Serbia',
            'code' => 'RS',
            ),
            188 => 
            array (
            'name' => 'Russian Federation',
            'code' => 'RU',
            ),
            189 => 
            array (
            'name' => 'Rwanda',
            'code' => 'RW',
            ),
            190 => 
            array (
            'name' => 'Saudi Arabia',
            'code' => 'SA',
            ),
            191 => 
            array (
            'name' => 'Solomon Islands',
            'code' => 'SB',
            ),
            192 => 
            array (
            'name' => 'Seychelles',
            'code' => 'SC',
            ),
            193 => 
            array (
            'name' => 'Sudan',
            'code' => 'SD',
            ),
            194 => 
            array (
            'name' => 'Sweden',
            'code' => 'SE',
            ),
            195 => 
            array (
            'name' => 'Singapore',
            'code' => 'SG',
            ),
            196 => 
            array (
            'name' => 'Saint Helena',
            'code' => 'SH',
            ),
            197 => 
            array (
            'name' => 'Slovenia',
            'code' => 'SI',
            ),
            198 => 
            array (
            'name' => 'Svalbard and Jan Mayen',
            'code' => 'SJ',
            ),
            199 => 
            array (
            'name' => 'Slovakia',
            'code' => 'SK',
            ),
            200 => 
            array (
            'name' => 'Sierra Leone',
            'code' => 'SL',
            ),
            201 => 
            array (
            'name' => 'San Marino',
            'code' => 'SM',
            ),
            202 => 
            array (
            'name' => 'Senegal',
            'code' => 'SN',
            ),
            203 => 
            array (
            'name' => 'Somalia',
            'code' => 'SO',
            ),
            204 => 
            array (
            'name' => 'Suriname',
            'code' => 'SR',
            ),
            205 => 
            array (
            'name' => 'Sao Tome and Principe',
            'code' => 'ST',
            ),
            206 => 
            array (
            'name' => 'El Salvador',
            'code' => 'SV',
            ),
            207 => 
            array (
            'name' => 'Sint Maarten',
            'code' => 'SX',
            ),
            208 => 
            array (
            'name' => 'Syrian Arab Republic',
            'code' => 'SY',
            ),
            209 => 
            array (
            'name' => 'Eswatini',
            'code' => 'SZ',
            ),
            210 => 
            array (
            'name' => 'Turks and Caicos Islands',
            'code' => 'TC',
            ),
            211 => 
            array (
            'name' => 'Chad',
            'code' => 'TD',
            ),
            212 => 
            array (
            'name' => 'French Southern Territories',
            'code' => 'TF',
            ),
            213 => 
            array (
            'name' => 'Togo',
            'code' => 'TG',
            ),
            214 => 
            array (
            'name' => 'Thailand',
            'code' => 'TH',
            ),
            215 => 
            array (
            'name' => 'Tajikistan',
            'code' => 'TJ',
            ),
            216 => 
            array (
            'name' => 'Tokelau',
            'code' => 'TK',
            ),
            217 => 
            array (
            'name' => 'Timor-Leste',
            'code' => 'TL',
            ),
            218 => 
            array (
            'name' => 'Turkmenistan',
            'code' => 'TM',
            ),
            219 => 
            array (
            'name' => 'Tunisia',
            'code' => 'TN',
            ),
            220 => 
            array (
            'name' => 'Tonga',
            'code' => 'TO',
            ),
            221 => 
            array (
            'name' => 'Turkey',
            'code' => 'TR',
            ),
            222 => 
            array (
            'name' => 'Trinidad and Tobago',
            'code' => 'TT',
            ),
            223 => 
            array (
            'name' => 'Tuvalu',
            'code' => 'TV',
            ),
            224 => 
            array (
            'name' => 'Taiwan',
            'code' => 'TW',
            ),
            225 => 
            array (
            'name' => 'Tanzania',
            'code' => 'TZ',
            ),
            226 => 
            array (
            'name' => 'Ukraine',
            'code' => 'UA',
            ),
            227 => 
            array (
            'name' => 'Uganda',
            'code' => 'UG',
            ),
            228 => 
            array (
            'name' => 'United States Minor Outlying Islands',
            'code' => 'UM',
            ),
            229 => 
            array (
            'name' => 'United States',
            'code' => 'US',
            ),
            230 => 
            array (
            'name' => 'Uruguay',
            'code' => 'UY',
            ),
            231 => 
            array (
            'name' => 'Uzbekistan',
            'code' => 'UZ',
            ),
            232 => 
            array (
            'name' => 'Vatican City',
            'code' => 'VA',
            ),
            233 => 
            array (
            'name' => 'Saint Vincent and the Grenadines',
            'code' => 'VC',
            ),
            234 => 
            array (
            'name' => 'Venezuela',
            'code' => 'VE',
            ),
            235 => 
            array (
            'name' => 'Virgin Islands, British',
            'code' => 'VG',
            ),
            236 => 
            array (
            'name' => 'Virgin Islands, U.S.',
            'code' => 'VI',
            ),
            237 => 
            array (
            'name' => 'Vietnam',
            'code' => 'VN',
            ),
            238 => 
            array (
            'name' => 'Vanuatu',
            'code' => 'VU',
            ),
            239 => 
            array (
            'name' => 'Wallis and Futuna',
            'code' => 'WF',
            ),
            240 => 
            array (
            'name' => 'Samoa',
            'code' => 'WS',
            ),
            241 => 
            array (
            'name' => 'Yemen',
            'code' => 'YE',
            ),
            242 => 
            array (
            'name' => 'Mayotte',
            'code' => 'YT',
            ),
            243 => 
            array (
            'name' => 'South Africa',
            'code' => 'ZA',
            ),
            244 => 
            array (
            'name' => 'Zambia',
            'code' => 'ZM',
            ),
            245 => 
            array (
            'name' => 'Zimbabwe',
            'code' => 'ZW',
            ),
        );
        return $countries;
    }
}//end


if (!function_exists('dynamicHit')) {
	function dynamicHit($req, $payload) {

        $url  = $req['url'];
        $type = $req['type'];
        $token= $req['token'];

        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_PORT => "3001",
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => [
            "x-auth-token: $token",
            "Content-Type: application/json"
          ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);
        return $response;
	}
} //end num

if (!function_exists('getToken')) {
	function getToken() {

        $ci = &get_instance();
        $userData =  $ci->session->userdata('adminData');
        $token =  $userData['userData']['token'];
        return $token;
	}
} //end num

if (!function_exists('dynamicHitPagination')) {
	function dynamicHitPagination($req) {

        $url  = $req['url'];
        $type = $req['type'];
        $token= $req['token'];
        $collectoin = [
            'collectionName' => $req['collectionName'],
            'status'         => $req['status'],
            'search'         => $req['search'],
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_PORT => "3001",
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_POSTFIELDS => json_encode($collectoin),
        CURLOPT_HTTPHEADER => [
            "x-auth-token: $token",
            "Content-Type: application/json"
          ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);
        return $response;
	}
} //end num

if(!function_exists('getAdminNotification')){
    function getAdminNotification(){

        $url  = 'http://3.120.159.133:3001/api/admin/getNotifications';
        $type = 'POST';
        $collectoin = [

            'collectionName' => 'admin_notification',
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_PORT => "3001",
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_POSTFIELDS => json_encode($collectoin),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
          ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);
        return $response;
    }
}
if(!function_exists('countAdminNotification')){
    function countAdminNotification(){

        $url  = 'http://3.120.159.133:3001/api/admin/getNotificationsCount';
        $type = 'POST';
        $collectoin = [
            'collectionName' => 'admin_notification',
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_PORT => "3001",
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_POSTFIELDS => json_encode($collectoin),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
          ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);
        return $response;
    }
}

if(!function_exists('saveImageData')){
    function saveImageData($insertArray){

        $url  = 'http://3.120.159.133:3001/api/admin/saveData';
        $type = 'POST';

        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_PORT => "3001",
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_POSTFIELDS => json_encode($insertArray),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
          ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);
        return true;
    }
}//end