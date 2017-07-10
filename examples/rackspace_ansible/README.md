Fully HA Wordpress on Docker Swarm in Rackspace Cloud
=====================================================
**! UNDER CONSTRUCTION !**

One-click (one ansible run) solution to deploy fully HA, horizontally scalable Wordpress application
to Rackspace Cloud, using Docker Swarm on Cloud Servers (for web serving), Cloud Load Balancer, 
Cloud DB (as Wordpress DB) and Cloud Files as CDN (for storing media files).


Architecture
------------

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


Steps
-----

This works for Ubuntu 16.04 LTS:

```shell
# Install Python virtualenv support and some Python dependencies
apt-get install python-virtualenv python-cryptography python-netifaces

# Create a virtualenv for Ansible
virtualenv --system-site-packages /opt/ansible

# Activate the virtualenv
source /opt/ansible/bin/activate

# Install Ansible and pyrax library
pip install ansible pyrax

# Clone the repository
git clone https://github.com/tomas-mazak/wordpress-docker.git
cd wordpress-docker/examples/rackspace_ansible/

# Create pyrax.cfg
export RAX_CREDS_FILE=./pyrax.cfg
export RAX_REGION=DFW
cp pyrax.cfg.example pyrax.cfg
# (edit pyrax.cfg and provide your Rackspace cloud user name and api key)

# Provision the environment
ansible-playbook -i rax.py site.yml

# Have fun with your example HA Wordpress ... :)

# When finished, you can tear down the whole environment to save costs:
ansible-playbook -i rax.py teardown.yml
```


TODO
----
1. Setup LB healthchecks
2. Setup iptables on nodes (disable all except 22 from public)
3. Setup registry service
4. Build and push WP image
5. Deploy WP service (stack)
