You can think of Kyverno as a subsystem that lets you create admission controllers via a YAML template instead of having
to write a whole Go microservice. The syntax is relatively simple which is good for picking it up quickly, but it may
be limiting in what you can accomplish. What I want it to accomplish is to keep me from sabotaging myself through
incorrect deployments and routing.

* `disallow_default_namespace.yaml`: Does what it says on the tin. Keeping the default namespace clean is considered
best practice.
