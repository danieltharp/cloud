resource "digitalocean_spaces_bucket" "spaces" {
  name          = "tharp"
  region        = "sfo3"
  acl           = "private"
  force_destroy = false
}