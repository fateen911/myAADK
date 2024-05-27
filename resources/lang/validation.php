<?php

return [

    'accepted' => 'The :attribute mesti diterima.',
    'active_url' => 'The :attribute bukan URL yang sah.',
    'after' => 'The :attribute mesti tarikh selepas :date.',
    'after_or_equal' => 'The :attribute mesti tarikh selepas atau sama dengan :date.',
    'alpha' => 'The :attribute hanya boleh mengandungi huruf.',
    'alpha_dash' => 'The :attribute hanya boleh mengandungi huruf, nombor, tanda sempang dan garis bawah.',
    'alpha_num' => 'The :attribute hanya boleh mengandungi huruf dan nombor.',
    'array' => 'The :attribute mesti array.',
    'before' => 'The :attribute mesti tarikh sebelum :date.',
    'before_or_equal' => 'The :attribute mesti tarikh sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'The :attribute mesti antara :min dan :max.',
        'file' => 'The :attribute mesti antara :min dan :max kilobytes.',
        'string' => 'The :attribute mesti antara :min dan :max aksara.',
        'array' => 'The :attribute mesti mempunyai antara :min dan :max item.',
    ],
    'boolean' => 'The :attribute field mesti benar atau salah.',
    'confirmed' => 'The :attribute pengesahan tidak sepadan.',
    'date' => 'The :attribute bukan tarikh yang sah.',
    'date_format' => 'The :attribute tidak sepadan dengan format :format.',
    'different' => 'The :attribute dan :other mesti berbeza.',
    'digits' => 'The :attribute mesti :digits digit.',
    'digits_between' => 'The :attribute mesti antara :min dan :max digit.',
    'dimensions' => 'The :attribute mempunyai dimensi imej yang tidak sah.',
    'distinct' => 'The :attribute field mempunyai nilai pendua.',
    'email' => 'The :attribute mesti alamat e-mel yang sah.',
    'exists' => 'The selected :attribute tidak sah.',
    'file' => 'The :attribute mesti fail.',
    'filled' => 'The :attribute field mesti mempunyai nilai.',
    'image' => 'The :attribute mesti imej.',
    'in' => 'The selected :attribute tidak sah.',
    'in_array' => 'The :attribute field tidak wujud dalam :other.',
    'integer' => 'The :attribute mesti integer.',
    'ip' => 'The :attribute mesti alamat IP yang sah.',
    'ipv4' => 'The :attribute mesti alamat IPv4 yang sah.',
    'ipv6' => 'The :attribute mesti alamat IPv6 yang sah.',
    'json' => 'The :attribute mesti rentetan JSON yang sah.',
    'max' => [
        'numeric' => 'The :attribute mungkin tidak lebih besar daripada :max.',
        'file' => 'The :attribute mungkin tidak lebih besar daripada :max kilobytes.',
        'string' => 'The :attribute mungkin tidak lebih besar daripada :max aksara.',
        'array' => 'The :attribute mungkin tidak mempunyai lebih daripada :max item.',
    ],
    'mimes' => 'The :attribute mesti fail jenis: :values.',
    'mimetypes' => 'The :attribute mesti fail jenis: :values.',
    'min' => [
        'numeric' => 'The :attribute mesti sekurang-kurangnya :min.',
        'file' => 'The :attribute mesti sekurang-kurangnya :min kilobytes.',
        'string' => 'The :attribute mesti sekurang-kurangnya :min aksara.',
        'array' => 'The :attribute mesti mempunyai sekurang-kurangnya :min item.',
    ],
    'not_in' => 'The selected :attribute tidak sah.',
    'not_regex' => 'The :attribute format tidak sah.',
    'numeric' => 'The :attribute mesti nombor.',
    'password' => 'The kata laluan tidak betul.',
    'present' => 'The :attribute field mesti hadir.',
    'regex' => 'The :attribute format tidak sah.',
    'required' => 'The :attribute field diperlukan.',
    'required_if' => 'The :attribute field diperlukan apabila :other adalah :value.',
    'required_unless' => 'The :attribute field diperlukan kecuali :other adalah dalam :values.',
    'required_with' => 'The :attribute field diperlukan apabila :values hadir.',
    'required_with_all' => 'The :attribute field diperlukan apabila :values hadir.',
    'required_without' => 'The :attribute field diperlukan apabila :values tidak hadir.',
    'required_without_all' => 'The :attribute field diperlukan apabila tiada satu pun daripada :values hadir.',
    'same' => 'The :attribute dan :other mesti sepadan.',
    'size' => [
        'numeric' => 'The :attribute mesti :size.',
        'file' => 'The :attribute mesti :size kilobytes.',
        'string' => 'The :attribute mesti :size aksara.',
        'array' => 'The :attribute mesti mengandungi :size item.',
    ],
    'starts_with' => 'The :attribute mesti bermula dengan salah satu daripada berikut: :values',
    'string' => 'The :attribute mesti rentetan.',
    'timezone' => 'The :attribute mesti zon yang sah.',
    'unique' => 'The :attribute sudah diambil.',
    'uploaded' => 'The :attribute gagal untuk memuat naik.',
    'url' => 'The :attribute format tidak sah.',
    'uuid' => 'The :attribute mesti UUID yang sah.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
