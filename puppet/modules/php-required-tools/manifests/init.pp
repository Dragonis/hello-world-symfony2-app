class php-required-tools {

    package { "python-software-properties":
        ensure => present
    }

    package { "curl":
        ensure => present
    }

    package { 'acl':
        ensure => installed
    }

    package { 'git':
        ensure => installed
    }

    package { "lynx-cur":
        ensure => present,
    }

}

include php-required-tools