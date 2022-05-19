This is a quick terraform script to spin up and attach NAT Gateways to the hub subnets, to allow for patching.

To create the gateways:

```
[centos@tokyo ~/cloud/apps/skipirc/nat-gateway]$ terraform apply
```

To destroy the gateways:

```
[centos@tokyo ~/cloud/apps/skipirc/nat-gateway]$ terraform destroy
```

PLEASE remember to destroy the gateways as soon as you're done using them, they're more expensive than the rest of the
network put together if left running 24/7.
