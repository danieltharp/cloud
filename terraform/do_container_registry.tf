resource "digitalocean_container_registry" "registry" {
  name                   = "tharp"
  subscription_tier_slug = "basic"
  region                 = "sfo3"
}

output "registry_endpoint" {
  value = digitalocean_container_registry.registry.endpoint
}

output "registry_size" {
  value = digitalocean_container_registry.registry.storage_usage_bytes
}
