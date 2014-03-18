class apache
{      
    package 
    { 
        "apache2":
            ensure  => present,
            require => [Exec['apt-get update'], Package['php5'], Package['php5-dev'], Package['php5-cli']]
    }
    
    service 
    { 
        "apache2":
            ensure      => running,
            enable      => true,
            require     => Package['apache2'],
            subscribe   => [
                File["/etc/apache2/mods-enabled/rewrite.load"],
                File["/etc/apache2/sites-available/000-default.conf"],
                File["/etc/apache2/conf-enabled/phpmyadmin.conf"]
            ],
    }

    file 
    { 
        "/etc/apache2/mods-enabled/rewrite.load":
            ensure  => link,
            target  => "/etc/apache2/mods-available/rewrite.load",
            require => Package['apache2'],
    }

    file 
    { 
        "/etc/apache2/sites-available/000-default.conf":
            ensure  => present,
            owner => root, group => root,
            source  => "/vagrant/puppet/templates/vhost",
            require => Package['apache2'],
            setenv => {
                'WORDPRESS_DB_USER' => 'awesome-project',
                'WORDPRESS_DB_PASSWORD' => '@we5omE-pAs5w0rD',
                'WORDPRESS_DB_HOST' => 'localhost',
                'WORDPRESS_DB_NAME' => 'awesome-project.local'
            }
    }

    exec 
    { 
        'echo "ServerName localhost" | sudo tee /etc/apache2/conf-enabled/fqdn.conf':
            require => Package['apache2'],
    }
}
