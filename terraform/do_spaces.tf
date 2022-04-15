# Note that you need to generate a Spaces access key if you're importing state 
# and expose them as SPACES_ACCESS_KEY_ID and SPACES_SECRET_ACCESS_KEY env vars.

resource "digitalocean_spaces_bucket" "spaces" {
  name          = "tharp"
  region        = "sfo3"
  acl           = "private"
  force_destroy = false
}

output "spaces_urn" {
    value = digitalocean_spaces_bucket.spaces.urn
}

output "spaces_domain" {
    value = digitalocean_spaces_bucket.spaces.bucket_domain_name
}
