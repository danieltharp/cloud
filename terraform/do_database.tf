resource "digitalocean_database_cluster" "mysql" {
  name       = "tharp-mysql"
  engine     = "mysql"
  version    = "8"
  size       = "db-s-1vcpu-1gb"
  region     = "tor1"
  node_count = 1
}

output "mysql_host" {
    value = digitalocean_database_cluster.mysql.host
}

output "mysql_private_host" {
    value = digitalocean_database_cluster.mysql.private_host
}

output "mysql_database" {
    value = digitalocean_database_cluster.mysql.database
}

output "mysql_username" {
    value = digitalocean_database_cluster.mysql.user
}

output "mysql_password" {
    value = digitalocean_database_cluster.mysql.password
    sensitive = true
}