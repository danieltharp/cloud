resource "digitalocean_droplet" "bastion" {
  name   = "bastion"
  region = "tor1"
  size   = "s-1vcpu-1gb-intel"
  image  = "rockylinux-8-x64"
  ssh_keys = [29137206] # e7:c2:22:4d:b5:40:81:98:30:0a:48:2e:c2:5e:89:5f
}

resource "digitalocean_floating_ip" "bastion_static_ip" {
  droplet_id = digitalocean_droplet.bastion.id
  region     = digitalocean_droplet.bastion.region
}

resource "digitalocean_volume" "bastion_volume" {
  region                  = "tor1"
  name                    = "bastion-root-volume"
  size                    = 20
  initial_filesystem_type = "ext4"
  description             = "Root volume for bastion host"
}

resource "digitalocean_volume_attachment" "bastion_volume_attach" {
  droplet_id = digitalocean_droplet.bastion.id
  volume_id  = digitalocean_volume.bastion_volume.id
}

output "bastion_ip" {
  value = digitalocean_floating_ip.bastion_static_ip.ip_address
}
