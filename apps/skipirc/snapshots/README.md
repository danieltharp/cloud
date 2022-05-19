This is a quick terraform script to snapshot the entire environment before doing any work.

To create the snapshots:

```
[centos@tokyo ~/cloud/apps/skipirc/snapshot]$ terraform apply
```

To delete the snapshots:

```
[centos@tokyo ~/cloud/apps/skipirc/snapshot]$ terraform destroy
```

Please remember to delete the snapshots when patching is completed and successful to avoid excess charges.
