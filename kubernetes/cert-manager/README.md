We'll use [cert-manager](https://cert-manager.io/) to handle the acquisition and renewal of certificates, primarily
through the HTTP (ACME) challenge method. As an alternative method, I could use Traefik or Caddy to replace Gloo and 
cert-manager, but I prefer Gloo.

This deployment will involve a Helm chart, a couple of custom resources, and a Gloo route delegation.

```
$ cd cloud/kubernetes/cert-manager

$ helm dependency build                                                                                                                                                                                             22-04-27 - 18:39:14 
Getting updates for unmanaged Helm repositories...
...Successfully got an update from the "https://charts.jetstack.io" chart repository
Update Complete. ⎈Happy Helming!⎈
Saving 1 charts
Downloading cert-manager from repo https://charts.jetstack.io
Deleting outdated charts

$ k create ns cert-manager                                                                                                                                                                                     :( 1 22-04-27 - 18:41:37 
namespace/cert-manager created

$ helm install cert-manager -n cert-manager . -f values.yaml                                                                                                                                                        22-04-27 - 18:42:17 
NAME: cert-manager
LAST DEPLOYED: Wed Apr 27 18:43:01 2022
NAMESPACE: cert-manager
STATUS: deployed
REVISION: 1
TEST SUITE: None

$ k get all -n cert-manager                                                                                                                                                                                         22-04-27 - 18:43:52 
NAME                                          READY   STATUS    RESTARTS   AGE
pod/cert-manager-6bbf595697-lqf5m             1/1     Running   0          48s
pod/cert-manager-cainjector-6bc9d758b-tj7pv   1/1     Running   0          48s
pod/cert-manager-webhook-586d45d5ff-6bxcf     1/1     Running   0          48s

NAME                           TYPE        CLUSTER-IP       EXTERNAL-IP   PORT(S)    AGE
service/cert-manager           ClusterIP   10.245.211.127   <none>        9402/TCP   50s
service/cert-manager-webhook   ClusterIP   10.245.207.30    <none>        443/TCP    50s

NAME                                      READY   UP-TO-DATE   AVAILABLE   AGE
deployment.apps/cert-manager              1/1     1            1           50s
deployment.apps/cert-manager-cainjector   1/1     1            1           50s
deployment.apps/cert-manager-webhook      1/1     1            1           50s

NAME                                                DESIRED   CURRENT   READY   AGE
replicaset.apps/cert-manager-6bbf595697             1         1         1       50s
replicaset.apps/cert-manager-cainjector-6bc9d758b   1         1         1       50s
replicaset.apps/cert-manager-webhook-586d45d5ff     1         1         1       50s

$ k apply -f cluster-issuer.yaml                                                                                                                                                                                    22-04-27 - 18:59:09 
clusterissuer.cert-manager.io/letsencrypt created

$ k apply -f service.yaml                                                                                                                                                                                           22-04-27 - 18:59:22 
service/acme-solver created
```
