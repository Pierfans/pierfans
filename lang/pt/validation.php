<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números e traços.',
    'ascii_only'           => 'O campo :attribute deve conter apenas letras, números e traços.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O campo :attribute deve ser um valor entre :min e :max.',
        'file'    => 'O arquivo :attribute deve ter entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não confere.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O campo :attribute possui dimensões de imagem inválidas (:min_width x :min_height px).',
    'distinct'             => 'O campo :attribute possui um valor duplicado.',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute é obrigatório.',
    'gt'                   => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file'    => 'O arquivo :attribute deve ter mais de :value kilobytes.',
        'string'  => 'O campo :attribute deve ter mais de :value caracteres.',
        'array'   => 'O campo :attribute deve ter mais de :value itens.',
    ],
    'gte'                  => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file'    => 'O arquivo :attribute deve ter :value kilobytes ou mais.',
        'string'  => 'O campo :attribute deve ter :value caracteres ou mais.',
        'array'   => 'O campo :attribute deve ter :value itens ou mais.',
    ],
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute deve ser um JSON válido.',
    'lt'                   => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file'    => 'O arquivo :attribute deve ter menos de :value kilobytes.',
        'string'  => 'O campo :attribute deve ter menos de :value caracteres.',
        'array'   => 'O campo :attribute deve ter menos de :value itens.',
    ],
    'lte'                  => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'file'    => 'O arquivo :attribute deve ter no máximo :value kilobytes.',
        'string'  => 'O campo :attribute deve ter no máximo :value caracteres.',
        'array'   => 'O campo :attribute não deve ter mais de :value itens.',
    ],
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file'    => 'O arquivo :attribute não pode ter mais que :max kilobytes.',
        'string'  => 'O campo :attribute não pode ter mais que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file'    => 'O arquivo :attribute deve ter pelo menos :min kilobytes.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'not_regex'            => 'O formato de :attribute é inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório, a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente.',
    'same'                 => 'Os campos :attribute e :other devem coincidir.',
    'size'                 => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file'    => 'O arquivo :attribute deve ter :size kilobytes.',
        'string'  => 'O campo :attribute deve ter :size caracteres.',
        'array'   => 'O campo :attribute deve conter :size itens.',
    ],
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser um fuso horário válido.',
    'unique'               => 'O campo :attribute já está em uso.',
    'uploaded'             => 'Falha ao enviar o arquivo :attribute.',
    'url'                  => 'O formato de :attribute é inválido.',
    'account_not_confirmed' => 'Sua conta não foi confirmada, verifique seu e-mail',
    'user_suspended'        => 'Sua conta foi suspensa, entre em contato conosco se for um erro',
    'letters'              => 'O campo :attribute deve conter pelo menos uma letra ou número',
    'video_url'            => 'URL inválida, só é suportado Youtube e Vimeo.',
    'update_max_length'    => 'A postagem não pode ter mais que :max caracteres.',
    'update_min_length'    => 'A postagem deve ter pelo menos :min caracteres.',
    'video_url_required'   => 'O campo Video URL é obrigatório quando o Conteúdo em Destaque for Vídeo.',

    /*
    |--------------------------------------------------------------------------
    | Linhas de Mensagem de Validação Personalizadas
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar mensagens de validação personalizadas para atributos
    | usando a convenção "attribute.rule" para nomear as linhas. Isso torna rápido
    | especificar uma mensagem de validação específica para uma dada regra de atributo.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'mensagem-personalizada',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos de Validação Personalizados
    |--------------------------------------------------------------------------
    |
    | As linhas a seguir são usadas para trocar placeholders de atributos
    | por algo mais amigável, como "Endereço de E-Mail" em vez
    | de "email". Isso simplesmente nos ajuda a deixar as mensagens um pouco mais limpas.
    |
    */

    'attributes' => [
        'agree_gdpr' => 'caixa Eu concordo com o processamento de dados pessoais',
        'agree_terms' => 'caixa Eu concordo com os Termos e Condições',
        'agree_terms_privacy' => 'caixa Eu concordo com os Termos e Condições e Política de Privacidade',
        'full_name' => 'Nome Completo',
        'name' => 'Nome',
        'username'  => 'Nome de Usuário',
        'username_email' => 'Nome de Usuário ou E-mail',
        'email'     => 'E-mail',
        'password'  => 'Senha',
        'password_confirmation' => 'Confirmação de Senha',
        'website'   => 'Site',
        'location' => 'Localização',
        'countries_id' => 'País',
        'twitter'   => 'Twitter',
        'facebook'   => 'Facebook',
        'google'   => 'Google',
        'instagram'   => 'Instagram',
        'comment' => 'Comentário',
        'title' => 'Título',
        'description' => 'Descrição',
        'old_password' => 'Senha Antiga',
        'new_password' => 'Nova Senha',
        'email_paypal' => 'E-mail PayPal',
        'email_paypal_confirmation' => 'Confirmação de E-mail PayPal',
        'bank_details' => 'Dados Bancários',
        'video_url' => 'URL do Vídeo',
        'categories_id' => 'Categoria',
        'story' => 'História',
        'image' => 'Imagem',
        'avatar' => 'Avatar',
        'message' => 'Mensagem',
        'profession' => 'Profissão',
        'thumbnail' => 'Miniatura',
        'address' => 'Endereço',
        'city' => 'Cidade',
        'zip' => 'CEP',
        'payment_gateway' => 'Gateway de Pagamento',
        'payment_gateway_tip' => 'Gateway de Pagamento',
        'MAIL_FROM_ADDRESS' => 'E-mail sem resposta (no-reply)',
        'FILESYSTEM_DRIVER' => 'Disco',
        'price' => 'Preço',
        'amount' => 'Quantia',
        'birthdate' => 'Data de Nascimento',
        'navbar_background_color' => 'Cor de fundo do Navbar',
        'navbar_text_color' => 'Cor do texto do Navbar',
        'footer_background_color' => 'Cor de fundo do Rodapé',
        'footer_text_color' => 'Cor do texto do Rodapé',

        'AWS_ACCESS_KEY_ID' => 'Chave Amazon',
        'AWS_SECRET_ACCESS_KEY' => 'Segredo Amazon',
        'AWS_DEFAULT_REGION' => 'Região Amazon',
        'AWS_BUCKET' => 'Bucket Amazon',

        'DOS_ACCESS_KEY_ID' => 'Chave DigitalOcean',
        'DOS_SECRET_ACCESS_KEY' => 'Segredo DigitalOcean',
        'DOS_DEFAULT_REGION' => 'Região DigitalOcean',
        'DOS_BUCKET' => 'Bucket DigitalOcean',

        'WAS_ACCESS_KEY_ID' => 'Chave Wasabi',
        'WAS_SECRET_ACCESS_KEY' => 'Segredo Wasabi',
        'WAS_DEFAULT_REGION' => 'Região Wasabi',
        'WAS_BUCKET' => 'Bucket Wasabi',

        //===== v2.0
        'BACKBLAZE_ACCOUNT_ID' => 'ID da Conta Backblaze',
        'BACKBLAZE_APP_KEY' => 'Chave Master da Aplicação Backblaze',
        'BACKBLAZE_BUCKET' => 'Nome do Bucket Backblaze',
        'BACKBLAZE_BUCKET_REGION' => 'Região do Bucket Backblaze',
        'BACKBLAZE_BUCKET_ID' => 'Endpoint do Bucket Backblaze',

        'VULTR_ACCESS_KEY' => 'Chave Vultr',
        'VULTR_SECRET_KEY' => 'Segredo Vultr',
        'VULTR_REGION' => 'Região Vultr',
        'VULTR_BUCKET' => 'Bucket Vultr',
    ],
];
