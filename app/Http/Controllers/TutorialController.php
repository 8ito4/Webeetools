<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        $tutorials = $this->getTutorials();
        return view('tutorials.index', compact('tutorials'));
    }

    public function show($slug)
    {
        $tutorials = $this->getTutorials();
        $tutorial = collect($tutorials)->firstWhere('slug', $slug);
        
        if (!$tutorial) {
            abort(404);
        }
        
        $tutorial['content'] = $this->getTutorialContent($slug);
        
        return view('tutorials.show', compact('tutorial'));
    }

    private function getTutorials()
    {
        return [
            [
                'slug' => 'instalar-nginx-ubuntu',
                'title' => 'Como Instalar e Configurar NGINX',
                'description' => 'Aprenda a instalar e configurar o servidor web NGINX no Ubuntu, Windows e macOS',
                'category' => 'Servidor Web',
                'difficulty' => 'Iniciante',
                'duration' => '15 min',
                'icon' => 'fas fa-server',
                'color' => 'bg-green-500',
                'tags' => ['nginx', 'servidor', 'web']
            ],
            [
                'slug' => 'instalar-php-8',
                'title' => 'Instalar PHP 8.x com Extensões para Laravel',
                'description' => 'Instalação completa do PHP 8.x com todas as extensões necessárias para desenvolvimento Laravel',
                'category' => 'Linguagem de Programação',
                'difficulty' => 'Iniciante',
                'duration' => '20 min',
                'icon' => 'fab fa-php',
                'color' => 'bg-blue-500',
                'tags' => ['php', 'laravel', 'desenvolvimento']
            ],
            [
                'slug' => 'configurar-laravel-projeto',
                'title' => 'Configurando um Projeto Laravel do Zero',
                'description' => 'Guia completo para criar e configurar um novo projeto Laravel com todas as melhores práticas',
                'category' => 'Framework',
                'difficulty' => 'Intermediário',
                'duration' => '30 min',
                'icon' => 'fab fa-laravel',
                'color' => 'bg-red-500',
                'tags' => ['laravel', 'php', 'framework']
            ]
        ];
    }

    public function getTutorialContent($slug)
    {
        $contents = [
            'instalar-nginx-ubuntu' => [
                'title' => 'Como Instalar e Configurar NGINX',
                'sections' => [
                    [
                        'title' => 'Introdução',
                        'content' => 'O NGINX é um servidor web de alta performance, proxy reverso e balanceador de carga. É conhecido por sua estabilidade, rico conjunto de recursos, configuração simples e baixo consumo de recursos.'
                    ],
                    [
                        'title' => 'Instalação',
                        'content' => 'Siga as instruções específicas para seu sistema operacional:',
                        'tabs' => [
                            'ubuntu' => [
                                'title' => 'Ubuntu/Debian',
                                'steps' => [
                                    [
                                        'title' => 'Atualizar lista de pacotes',
                                        'code' => 'sudo apt update'
                                    ],
                                    [
                                        'title' => 'Instalar NGINX',
                                        'code' => 'sudo apt install nginx'
                                    ],
                                    [
                                        'title' => 'Verificar status',
                                        'code' => 'sudo systemctl status nginx'
                                    ]
                                ]
                            ],
                            'windows' => [
                                'title' => 'Windows',
                                'steps' => [
                                    [
                                        'title' => 'Baixar NGINX',
                                        'content' => 'Acesse nginx.org/en/download.html e baixe a versão Windows'
                                    ],
                                    [
                                        'title' => 'Extrair arquivos',
                                        'content' => 'Extraia o arquivo ZIP para C:\\nginx'
                                    ],
                                    [
                                        'title' => 'Executar NGINX',
                                        'code' => 'cd C:\\nginx\nstart nginx'
                                    ]
                                ]
                            ],
                            'macos' => [
                                'title' => 'macOS',
                                'steps' => [
                                    [
                                        'title' => 'Instalar Homebrew (se necessário)',
                                        'code' => '/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"'
                                    ],
                                    [
                                        'title' => 'Instalar NGINX',
                                        'code' => 'brew install nginx'
                                    ],
                                    [
                                        'title' => 'Iniciar NGINX',
                                        'code' => 'brew services start nginx'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Configuração Básica',
                        'content' => 'Após a instalação, vamos configurar o NGINX:',
                        'steps' => [
                            [
                                'title' => 'Editar arquivo de configuração',
                                'code' => 'sudo nano /etc/nginx/sites-available/default'
                            ],
                            [
                                'title' => 'Configuração básica de servidor',
                                'code' => 'server {\n    listen 80;\n    server_name localhost;\n    root /var/www/html;\n    index index.html index.htm;\n\n    location / {\n        try_files $uri $uri/ =404;\n    }\n}'
                            ]
                        ]
                    ]
                ]
            ],
            'instalar-php-8' => [
                'title' => 'Instalar PHP 8.x com Extensões para Laravel',
                'sections' => [
                    [
                        'title' => 'Introdução',
                        'content' => 'O PHP 8.x trouxe muitas melhorias de performance e novos recursos. Para desenvolvimento Laravel, precisamos instalar PHP com extensões específicas.'
                    ],
                    [
                        'title' => 'Instalação do PHP 8.x',
                        'content' => 'Siga as instruções para seu sistema operacional:',
                        'tabs' => [
                            'ubuntu' => [
                                'title' => 'Ubuntu/Debian',
                                'steps' => [
                                    [
                                        'title' => 'Adicionar repositório PHP',
                                        'code' => 'sudo add-apt-repository ppa:ondrej/php\nsudo apt update'
                                    ],
                                    [
                                        'title' => 'Instalar PHP 8.3',
                                        'code' => 'sudo apt install php8.3'
                                    ],
                                    [
                                        'title' => 'Instalar extensões essenciais',
                                        'code' => 'sudo apt install php8.3-cli php8.3-fpm php8.3-mysql php8.3-zip php8.3-gd php8.3-mbstring php8.3-curl php8.3-xml php8.3-bcmath php8.3-intl'
                                    ]
                                ]
                            ],
                            'windows' => [
                                'title' => 'Windows',
                                'steps' => [
                                    [
                                        'title' => 'Baixar PHP',
                                        'content' => 'Acesse windows.php.net e baixe a versão Thread Safe'
                                    ],
                                    [
                                        'title' => 'Extrair e configurar',
                                        'content' => 'Extraia para C:\\php e adicione ao PATH do sistema'
                                    ],
                                    [
                                        'title' => 'Configurar php.ini',
                                        'content' => 'Copie php.ini-development para php.ini e descomente as extensões necessárias'
                                    ]
                                ]
                            ],
                            'macos' => [
                                'title' => 'macOS',
                                'steps' => [
                                    [
                                        'title' => 'Instalar PHP via Homebrew',
                                        'code' => 'brew install php@8.3'
                                    ],
                                    [
                                        'title' => 'Vincular versão',
                                        'code' => 'brew link php@8.3 --force'
                                    ],
                                    [
                                        'title' => 'Verificar instalação',
                                        'code' => 'php -v'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Instalar Composer',
                        'content' => 'O Composer é essencial para gerenciar dependências PHP:',
                        'steps' => [
                            [
                                'title' => 'Baixar installer',
                                'code' => 'curl -sS https://getcomposer.org/installer | php'
                            ],
                            [
                                'title' => 'Mover para executáveis globais',
                                'code' => 'sudo mv composer.phar /usr/local/bin/composer'
                            ],
                            [
                                'title' => 'Verificar instalação',
                                'code' => 'composer --version'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $contents[$slug] ?? null;
    }
} 