Here we use [Gloo Edge](https://www.solo.io/products/gloo-edge/) to be our edge proxy. It wraps Envoy with a lot of 
nice features, most of which I'm not using given the scale of this deployment.

The general logic for service delegation is that subdomains get their own Virtual Service, and paths off of the root 
domain just get delegated Route Tables. This is to keep things clean from an SSL certificate management perspective. In
your day-to-day in production this would probably be coupled with some sort of admission controller that only allows the
new Virtual Service if the domain matches what you permit.

This was the first piece installed in the K8s cluster so was done without the benefit of a CI/CD pipeline initially.

```
$ cd cloud/kubernetes/gloo

$ k create ns gloo-system
namespace/gloo-system created

$ helm dependency build
Hang tight while we grab the latest from your chart repositories...
...Successfully got an update from the "gloo" chart repository
Update Complete. ⎈Happy Helming!⎈
Saving 1 charts
Downloading gloo from repo https://storage.googleapis.com/solo-public-helm
Deleting outdated charts

$ helm install gloo . -n gloo-system -f values.yaml
NAME: gloo
LAST DEPLOYED: Wed Apr 27 13:44:08 2022
NAMESPACE: gloo-system
STATUS: deployed
REVISION: 1
TEST SUITE: None

$ k get all -n gloo-system                                                                                                                                                                                          22-04-27 - 13:44:50 
NAME                                 READY   STATUS    RESTARTS   AGE
pod/discovery-b499f8f8b-qmwwx        1/1     Running   0          19s
pod/gateway-6fb865b46b-77lz7         0/1     Running   0          19s
pod/gateway-proxy-7bf7d8fccc-c7cnf   1/1     Running   0          19s
pod/gloo-5ddc7b4d59-m2sr6            0/1     Pending   0          19s

NAME                    TYPE           CLUSTER-IP      EXTERNAL-IP   PORT(S)                               AGE
service/gateway         ClusterIP      10.245.141.87   <none>        443/TCP                               20s
service/gateway-proxy   LoadBalancer   10.245.2.41     <pending>     80:32395/TCP,443:31219/TCP            20s
service/gloo            ClusterIP      10.245.33.138   <none>        9977/TCP,9976/TCP,9988/TCP,9979/TCP   20s

NAME                            READY   UP-TO-DATE   AVAILABLE   AGE
deployment.apps/discovery       1/1     1            1           20s
deployment.apps/gateway         0/1     1            0           20s
deployment.apps/gateway-proxy   1/1     1            1           20s
deployment.apps/gloo            0/1     1            0           20s

NAME                                       DESIRED   CURRENT   READY   AGE
replicaset.apps/discovery-b499f8f8b        1         1         1       21s
replicaset.apps/gateway-6fb865b46b         1         1         0       21s
replicaset.apps/gateway-proxy-7bf7d8fccc   1         1         1       21s
replicaset.apps/gloo-5ddc7b4d59            1         1         0       21s
```