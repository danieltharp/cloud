I'm using [Datadog](https://datadoghq.com) as my logging and monitoring platform. This is my preferred platform as it
encompasses all of the various facets you need for proper SRE in one place. Since we're using DigitalOcean instead of
AWS, the cost drops off significantly. We'll use this for basic alerting about cluster health mostly, with alerts going
to Slack.

I had to deploy this one a bit differently, it didn't like something about being wrapped in another Helm chart.

```
$ k create ns datadog                                                                                                                                                                       22-04-29 - 9:41:33 
namespace/datadog created

$ helm repo add datadog https://helm.datadoghq.com                                                                                                                                    :( 1 22-04-29 - 18:18:42 
"datadog" has been added to your repositories

$  helm repo update                                                                                                                                                                         22-04-29 - 18:18:53 
Hang tight while we grab the latest from your chart repositories...
...Successfully got an update from the "datadog" chart repository
Update Complete. ⎈Happy Helming!⎈


$ helm install datadog -f values.yaml --set datadog.site='datadoghq.com' --set datadog.apiKey='<snip>' datadog/datadog -n datadog 
NAME: datadog
LAST DEPLOYED: Fri Apr 29 18:19:05 2022
NAMESPACE: datadog
STATUS: deployed
REVISION: 1
TEST SUITE: None
NOTES:
Datadog agents are spinning up on each node in your cluster. After a few
minutes, you should see your agents starting in your event stream:
    https://app.datadoghq.com/event/explorer


$ k get all -n datadog                                                                                                                                                                      22-04-29 - 9:44:34 
NAME                                              READY   STATUS    RESTARTS   AGE
pod/datadog-2wpgf                                 2/3     Running   0          40s
pod/datadog-956zr                                 2/3     Running   0          40s
pod/datadog-cluster-agent-77c97fdb7f-j7n5q        1/1     Running   0          40s
pod/datadog-kube-state-metrics-6fb56bf889-2pt5r   1/1     Running   0          40s

NAME                                 TYPE        CLUSTER-IP      EXTERNAL-IP   PORT(S)    AGE
service/datadog                      ClusterIP   10.245.74.147   <none>        8125/UDP   40s
service/datadog-cluster-agent        ClusterIP   10.245.59.26    <none>        5005/TCP   40s
service/datadog-kube-state-metrics   ClusterIP   10.245.246.81   <none>        8080/TCP   40s

NAME                     DESIRED   CURRENT   READY   UP-TO-DATE   AVAILABLE   NODE SELECTOR            AGE
daemonset.apps/datadog   2         2         0       2            0           kubernetes.io/os=linux   41s

NAME                                         READY   UP-TO-DATE   AVAILABLE   AGE
deployment.apps/datadog-cluster-agent        1/1     1            1           41s
deployment.apps/datadog-kube-state-metrics   1/1     1            1           41s

NAME                                                    DESIRED   CURRENT   READY   AGE
replicaset.apps/datadog-cluster-agent-77c97fdb7f        1         1         1       42s
replicaset.apps/datadog-kube-state-metrics-6fb56bf889   1         1         1       42s
```

One thing I noticed is the `2/3` of Datadog pods running. I suspect it's trying to deploy the pod to the control plane
and it's not allowed to.
