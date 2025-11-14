<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Mensagens de validação
    |--------------------------------------------------------------------------
    |
    | As mensagens de validação usadas pelo sistema. Você pode trocar
    | qualquer uma dessas mensagens conforme necessário. Algumas regras
    | têm várias versões como 'min' e 'max'. Coloque a versão que se aplica
    | ao tipo (numeric, file, string, array).
    |
    */

    'accepted'             => 'O campo :attribute deve ser aceito. ',
    'active_url'           => 'O campo :attribute não é uma URL válida. ',
    'after'                => 'O campo :attribute deve ser uma data posterior a :date. ',
    'after_or_equal'       => 'O campo :attribute deve ser uma data posterior ou igual a :date. ',
    'alpha'                => 'O campo :attribute deve conter apenas letras. ',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números, traços e underlines. ',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números. ',
    'array'                => 'O campo :attribute deve ser um array. ',
    'attached'             => 'Este :attribute já está anexado. ',
    'before'               => 'O campo :attribute deve ser uma data anterior a :date. ',
    'before_or_equal'      => 'O campo :attribute deve ser uma data anterior ou igual a :date. ',
    
    'between' => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max. ',
        'file'    => 'O arquivo :attribute deve ter entre :min e :max kilobytes. ',
        'string'  => 'O campo :attribute deve ter entre :min e :max caracteres. ',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens. ',
    ],

    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso. ',
    'confirmed'            => 'A confirmação para :attribute não corresponde. ',
    'current_password'     => 'A senha informada está incorreta. ',
    'date'                 => 'O campo :attribute não é uma data válida. ',
    'date_equals'          => 'O campo :attribute deve ser uma data igual a :date. ',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format. ',
    'different'            => 'Os campos :attribute e :other devem ser diferentes. ',
    'digits'               => 'O campo :attribute deve ter :digits dígitos. ',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos. ',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas. ',
    'distinct'             => 'O campo :attribute possui um valor duplicado. ',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido. ',
    'ends_with'            => 'O campo :attribute deve terminar com um dos seguintes: :values. ',
    'exists'               => 'O valor selecionado para :attribute é inválido. ',
    'file'                 => 'O campo :attribute deve ser um arquivo. ',
    'filled'               => 'O campo :attribute deve ter um valor. ',

    'gt' => [
        'numeric' => 'O campo :attribute deve ser maior que :value. ',
        'file'    => 'O arquivo :attribute deve ser maior que :value kilobytes. ',
        'string'  => 'O campo :attribute deve ter mais de :value caracteres. ',
        'array'   => 'O campo :attribute deve ter mais de :value itens. ',
    ],

    'gte' => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value. ',
        'file'    => 'O arquivo :attribute deve ter no mínimo :value kilobytes. ',
        'string'  => 'O campo :attribute deve ter no mínimo :value caracteres. ',
        'array'   => 'O campo :attribute deve ter no mínimo :value itens. ',
    ],

    'image'                => 'O campo :attribute deve ser uma imagem. ',
    'in'                   => 'O valor selecionado para :attribute é inválido. ',
    'in_array'             => 'O campo :attribute não existe em :other. ',
    'integer'              => 'O campo :attribute deve ser um número inteiro. ',
    'ip'                   => 'O campo :attribute deve ser um endereço IP válido. ',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido. ',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido. ',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida. ',

    'lt' => [
        'numeric' => 'O campo :attribute deve ser menor que :value. ',
        'file'    => 'O arquivo :attribute deve ser menor que :value kilobytes. ',
        'string'  => 'O campo :attribute deve ter menos de :value caracteres. ',
        'array'   => 'O campo :attribute deve ter menos de :value itens. ',
    ],

    'lte' => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value. ',
        'file'    => 'O arquivo :attribute deve ter no máximo :value kilobytes. ',
        'string'  => 'O campo :attribute deve ter no máximo :value caracteres. ',
        'array'   => 'O campo :attribute não deve ter mais que :value itens. ',
    ],

    'max' => [
        'numeric' => 'O campo :attribute não pode ser maior que :max. ',
        'file'    => 'O arquivo :attribute não pode ser maior que :max kilobytes. ',
        'string'  => 'O campo :attribute não pode ter mais que :max caracteres. ',
        'array'   => 'O campo :attribute não pode ter mais que :max itens. ',
    ],

    'mimes'       => 'O campo :attribute deve ser um arquivo do tipo: :values. ',
    'mimetypes'   => 'O campo :attribute deve ser um arquivo do tipo: :values. ',

    'min' => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min. ',
        'file'    => 'O arquivo :attribute deve ter pelo menos :min kilobytes. ',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres. ',
        'array'   => 'O campo :attribute deve ter pelo menos :min itens. ',
    ],

    'multiple_of' => 'O campo :attribute deve ser múltiplo de :value. ',
    'not_in'      => 'O valor selecionado para :attribute é inválido. ',
    'not_regex'   => 'O formato do campo :attribute é inválido. ',
    'numeric'     => 'O campo :attribute deve ser um número. ',
    'password'    => 'A senha está incorreta. ',
    'present'     => 'O campo :attribute deve estar presente. ',
    'prohibited'  => 'O campo :attribute é proibido. ',

    'prohibited_if'     => 'O campo :attribute é proibido quando :other é :value. ',
    'prohibited_unless' => 'O campo :attribute é proibido, a menos que :other esteja em :values. ',
    'prohibits'         => 'O campo :attribute impede :other de estar presente. ',

    'regex'                => 'O formato do campo :attribute é inválido. ',
    'required'             => 'O campo :attribute é obrigatório. ',
    'required_if'          => 'O campo :attribute é obrigatório quando :other for :value. ',
    'required_unless'      => 'O campo :attribute é obrigatório a menos que :other esteja em :values. ',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente. ',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes. ',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente. ',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente. ',

    'same' => 'Os campos :attribute e :other devem corresponder. ',

    'size' => [
        'numeric' => 'O campo :attribute deve ser :size. ',
        'file'    => 'O arquivo :attribute deve ter :size kilobytes. ',
        'string'  => 'O campo :attribute deve ter :size caracteres. ',
        'array'   => 'O campo :attribute deve conter :size itens. ',
    ],

    'starts_with' => 'O campo :attribute deve começar com um dos seguintes: :values. ',
    'string'      => 'O campo :attribute deve ser uma string. ',
    'timezone'    => 'O campo :attribute deve ser um fuso horário válido. ',
    'unique'      => 'O valor informado para :attribute já está em uso. ',
    'uploaded'    => 'Falha ao fazer upload do arquivo :attribute. ',
    'url'         => 'O formato do campo :attribute é inválido. ',
    'uuid'        => 'O campo :attribute deve ser um UUID válido. ',

    /*
    |--------------------------------------------------------------------------
    | CUSTOM VALIDATION MESSAGES
    |--------------------------------------------------------------------------
    */

    'custom' => [

        // Campos gerais
        'nome' => [
            'required' => 'O nome é obrigatório.',
            'max'      => 'O nome não pode ter mais que :max caracteres.',
        ],

        'email' => [
            'required' => 'O e-mail é obrigatório.',
            'email'    => 'Informe um e-mail válido.',
            'unique'   => 'Este e-mail já está cadastrado.',
        ],

        'senha' => [
            'required'  => 'A senha é obrigatória.',
            'min'       => 'A senha deve ter pelo menos :min caracteres.',
            'confirmed' => 'A confirmação da senha não confere.',
        ],

        'assunto' => [
            'required' => 'O assunto é obrigatório.',
        ],

        'mensagem' => [
            'required' => 'A mensagem é obrigatória.',
        ],

        // UsuarioController
        'fotoPerfil' => [
            'image' => 'A foto de perfil deve ser uma imagem (jpg, png, gif).',
            'max'   => 'A foto de perfil não pode ter mais que :max kilobytes.',
        ],

        'ehAdmin' => [
            'boolean' => 'O campo administrador deve ser verdadeiro ou falso.',
        ],

        'status' => [
            'in' => 'O status informado é inválido.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTES
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name'                  => 'nome',
        'username'              => 'nome de usuário',
        'email'                 => 'e-mail',
        'first_name'            => 'primeiro nome',
        'last_name'             => 'sobrenome',
        'password'              => 'senha',
        'password_confirmation' => 'confirmação de senha',
        'current_password'      => 'senha atual',
        'remember'              => 'lembrar',

        // Arquivos
        'file'   => 'arquivo',
        'avatar' => 'avatar',
        'photo'  => 'foto',
        'image'  => 'imagem',

        // UsuarioController
        'nomeUsuario'  => 'nome completo',
        'emailUsuario' => 'e-mail',
        'senhaUsuario' => 'senha',
        'fotoPerfil'   => 'foto de perfil',
        'ehAdmin'      => 'administrador',
        'status'       => 'status',
    ],

];
