We'll be using [ArgoCD](https://argo-cd.readthedocs.io/en/stable/) as our CD layer from within the cluster we've created
from the terraform resources. I currently intend to have GitHub Actions provide the CI (docker builds) and Argo to
handle the CD. If it ends up having to support multiple environments, I'll likely insert Kustomize into the mix.

This was deployed by hand since we want it to handle the CD in the future.

```
$ cd cloud/kubernetes/argo-cd

$ k create ns argo-cd                                                                                                                                                                                               22-04-27 - 14:09:30 
namespace/argo-cd created

$ helm dependency build                                                                                                                                                                                        :( 1 22-04-27 - 14:12:48 
Getting updates for unmanaged Helm repositories...
...Successfully got an update from the "https://argoproj.github.io/argo-helm" chart repository
Update Complete. ⎈Happy Helming!⎈
Saving 1 charts
Downloading argo-cd from repo https://argoproj.github.io/argo-helm
Deleting outdated charts

$ helm install argo-cd . -n argo-cd -f values.yaml                                                                                                                                                                  22-04-27 - 14:13:06 
NAME: argo-cd
LAST DEPLOYED: Wed Apr 27 14:13:18 2022
NAMESPACE: argo-cd
STATUS: deployed
REVISION: 1
TEST SUITE: None

$ k get all -n argo-cd                                                                                                                                                                                              22-04-27 - 14:13:42 
NAME                                                            READY   STATUS    RESTARTS   AGE
pod/argo-cd-argocd-application-controller-0                     1/1     Running   0          2m52s
pod/argo-cd-argocd-applicationset-controller-64dc8d5498-dblrp   1/1     Running   0          2m52s
pod/argo-cd-argocd-dex-server-99b465c88-kdpdx                   1/1     Running   0          2m53s
pod/argo-cd-argocd-notifications-controller-668d9495bb-nshj6    1/1     Running   0          2m52s
pod/argo-cd-argocd-redis-5c8d5b5f6-9vm76                        1/1     Running   0          2m53s
pod/argo-cd-argocd-repo-server-6696fc6f86-6zxh8                 1/1     Running   0          2m52s
pod/argo-cd-argocd-server-6f67cddd75-jtv9k                      1/1     Running   0          2m52s

NAME                                               TYPE        CLUSTER-IP       EXTERNAL-IP   PORT(S)             AGE
service/argo-cd-argocd-application-controller      ClusterIP   10.245.125.186   <none>        8082/TCP            2m54s
service/argo-cd-argocd-applicationset-controller   ClusterIP   10.245.110.25    <none>        7000/TCP            2m54s
service/argo-cd-argocd-dex-server                  ClusterIP   10.245.184.104   <none>        5556/TCP,5557/TCP   2m54s
service/argo-cd-argocd-redis                       ClusterIP   10.245.231.207   <none>        6379/TCP            2m54s
service/argo-cd-argocd-repo-server                 ClusterIP   10.245.165.123   <none>        8081/TCP            2m54s
service/argo-cd-argocd-server                      ClusterIP   10.245.222.132   <none>        80/TCP,443/TCP      2m54s

NAME                                                       READY   UP-TO-DATE   AVAILABLE   AGE
deployment.apps/argo-cd-argocd-applicationset-controller   1/1     1            1           2m55s
deployment.apps/argo-cd-argocd-dex-server                  1/1     1            1           2m55s
deployment.apps/argo-cd-argocd-notifications-controller    1/1     1            1           2m55s
deployment.apps/argo-cd-argocd-redis                       1/1     1            1           2m55s
deployment.apps/argo-cd-argocd-repo-server                 1/1     1            1           2m55s
deployment.apps/argo-cd-argocd-server                      1/1     1            1           2m55s

NAME                                                                  DESIRED   CURRENT   READY   AGE
replicaset.apps/argo-cd-argocd-applicationset-controller-64dc8d5498   1         1         1       2m55s
replicaset.apps/argo-cd-argocd-dex-server-99b465c88                   1         1         1       2m56s
replicaset.apps/argo-cd-argocd-notifications-controller-668d9495bb    1         1         1       2m56s
replicaset.apps/argo-cd-argocd-redis-5c8d5b5f6                        1         1         1       2m56s
replicaset.apps/argo-cd-argocd-repo-server-6696fc6f86                 1         1         1       2m56s
replicaset.apps/argo-cd-argocd-server-6f67cddd75                      1         1         1       2m56s

NAME                                                     READY   AGE
statefulset.apps/argo-cd-argocd-application-controller   1/1     2m55s
```