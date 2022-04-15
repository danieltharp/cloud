resource "digitalocean_kubernetes_cluster" "cluster" {
  name   = "koobernetes-eh"
  region = "tor1"

  version = "1.22.8-do.0"

  node_pool {
    name       = "friendly-canadian-node-pool"
    size       = "s-1vcpu-2gb"
    auto_scale = true
    min_nodes = 2
    max_nodes = 5
  }

  lifecycle {
    ignore_changes = [updated_at]
  }
}

output "cluster_ip" {
    value = digitalocean_kubernetes_cluster.cluster.ipv4_address
}

output "cluster_endpoint" {
    value = digitalocean_kubernetes_cluster.cluster.endpoint
}

output "cluster_status" {
    value = digitalocean_kubernetes_cluster.cluster.status
}
