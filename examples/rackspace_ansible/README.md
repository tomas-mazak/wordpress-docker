Fully HA Wordpress on Docker Swarm in Rackspace Cloud
=====================================================
[meaty description]

```
                               +-----------+
                               |           |
                               |   Cloud   |
                               |   Files   | <--------------------------+
                               |           |                            |
                               +--+-----+--+                            |
                                  ^     ^                               |
                                  |     |                               |
                                  |     |                               |
                          +-------+-----+--------+                      +---> (User)
                          |                      +---------+            |
                     +----+ wordpress+frontend+1 |         |            |
+---------------+    |    |                      |     +---+------+     |
|               |    |    +-------------+--------+     |          |     |
|   Cloud DB    +----+                  |              |          |     |
|    MySQL      |                       |              | Cloud LB | <---+
|               |                       |              |          |
|    (data)     +----+                  |              |          |
|               |    |    +-------------+--------+     +---+------+
+---------------+    |    |                      |         |
                     +----+ wordpress+frontend+2 +---------+
                          |                      |
                          +----------------------+
```

1. Bootstrap ansible (not to forget to mention pyrax library, test it on clean Ubuntu)
2. Show how to run site playbook
3. Describe teardown playbook as well

TODO
----
1. Documentation (this file)
2. Setup LB healthchecks
3. Setup iptables on nodes (disable all except 22 from public)
4. Setup registry service
5. Build and push WP image
6. Deploy WP service (stack)
