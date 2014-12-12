class mysql::install {
  package { 'mysql-server':
    ensure => installed
  }
  package { 'libmysqlclient-dev':
    ensure => installed
  }
}


class mysql::configure (
  $dbname   = 'symfony',
  $username = 'symfony',
  $password = 'symfony'
) {

  exec { 'mysql::create-db':
    unless => "/usr/bin/mysql -uvagrant -pvagrant",
    command => "/usr/bin/mysql -uroot -e \"create schema ${dbname} default character set utf8 collate utf8_polish_ci;\"",
    require => Class['mysql::install']
  }
  exec { 'mysql::create-db-user':
    unless => "/usr/bin/mysql -uvagrant -pvagrant",
    command => "/usr/bin/mysql -uroot -e \"grant all on ${dbname}.* to '${username}'@'%' identified by '${password}';\"",
    require => Exec['mysql::create-db']
  }
  exec { 'mysql::create-db-user2':
    unless => "/usr/bin/mysql -uvagrant -pvagrant",
    command => "/usr/bin/mysql -uroot -e \"grant all on ${dbname}.* to ${username}@localhost identified by '${password}';\"",
    require => Exec['mysql::create-db']
  }
  exec { 'mysql::flush-privileges':
    command => "/usr/bin/mysql -uroot -e \"flush privileges;\"",
    require => Exec['mysql::create-db-user', 'mysql::create-db-user2']
  }
}

class mysql::run {
  service { mysql:
    enable => true,
    ensure => running,
    hasstatus => true,
    hasrestart => true,
    subscribe => Package['mysql-server'],
    require => Class['mysql::install']
  }
}

include mysql::install
include mysql::configure
include mysql::run
