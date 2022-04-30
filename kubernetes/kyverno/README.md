I'm using [Kyverno](https://kyverno.io/) initially as guard rails, but as time goes on I'll use it to implement security
more thoroughly in the cluster.

The first thing I want it for is to keep myself from inadvertently creating things in the default namespace. After that,
I think I'll look at trying to get it to reject overly broad Gloo virtual services.

```
$ cd cloud/kubernetes/kyverno

$ helm dependency build                                                                                                                                                                    22-04-29 - 18:35:52 
Getting updates for unmanaged Helm repositories...
...Successfully got an update from the "https://kyverno.github.io/kyverno/" chart repository
Update Complete. ⎈Happy Helming!⎈
Saving 1 charts
Downloading kyverno from repo https://kyverno.github.io/kyverno/
Deleting outdated charts


$ helm install kyverno -n kyverno . -f values.yaml --create-namespace                                                                                                                      22-04-29 - 18:36:19 
NAME: kyverno
LAST DEPLOYED: Fri Apr 29 18:36:49 2022
NAMESPACE: kyverno
STATUS: deployed
REVISION: 1


$ k get all -n kyverno                                                                                                                                                                     22-04-29 - 18:37:04 
NAME                          READY   STATUS    RESTARTS   AGE
pod/kyverno-547bb6f84-22vvb   1/1     Running   0          2m

NAME                          TYPE        CLUSTER-IP       EXTERNAL-IP   PORT(S)    AGE
service/kyverno-svc           ClusterIP   10.245.162.147   <none>        443/TCP    2m2s
service/kyverno-svc-metrics   ClusterIP   10.245.208.178   <none>        8000/TCP   2m2s

NAME                      READY   UP-TO-DATE   AVAILABLE   AGE
deployment.apps/kyverno   1/1     1            1           2m2s

NAME                                DESIRED   CURRENT   READY   AGE
replicaset.apps/kyverno-547bb6f84   1         1         1       2m3s

$ k apply -n kyverno -f policies/disallow_default_namespace.yaml                                                                                                                           22-04-29 - 18:40:59 
clusterpolicy.kyverno.io/disallow-default-namespace created

$ k run nginx --image=nginx                                                                                                                                                           :( 1 22-04-29 - 18:49:01 
Error from server: admission webhook "validate.kyverno.svc-fail" denied the request: 

resource Pod/default/nginx was blocked due to the following policies

disallow-default-namespace:
  validate-namespace: 'validation error: Using ''default'' namespace is not allowed.
    Rule validate-namespace failed at path /metadata/namespace/'
```
