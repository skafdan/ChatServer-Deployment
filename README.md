# ChatServer-Deployment- COSC349 - Assignment 2
A deployment of a Java TCP chatserver using cloud services, namely Amazon webservices.

## Cloning
This project contains a submodule use `git clone --recurse-submodules git@github.com:skafdan/ChatServer-Deployment.git` to clone with submodule.

# AWS authentication
The vagrant file uses the aws plugin by [mitchellh](https://github.com/mitchellh/vagrant-aws).
Three environment variables from your AWS account, need to be set for your deployment to work; 
- access_key_id, `AWS_ACCESS_KEY_ID`
- secret_access_key, `AWS_SECRET_ACCESS_KEY`
- session_token,`AWS_SESSION_TOKEN`

In addition a ssh keypair needs to be set and the private key must be present somewhere accessible on your system.

Vagrantfile:
```
    aws.keypair_name = <your keypair name>

    aws.ami = "ami-09e67e426f25ce0d7"
    aws.instance_type = "t2.micro" 
    aws.security_groups = "chatserver"
    override.ssh.username = "ubuntu"
    override.ssh.private_key_path = "/path/to/<privatekey.pem>"

```

## Submodule documentation
# ChatServer
A simple terminal chat-server and terminal client written in Java that uses TCP 
and TLS encryption.

## Dependencies 

- `JDK 16` - Written using `openjdk-jdk-16`, tested `JDk-8` also works.
- `mariadb-JDBC 2.7.3` this can be downloaded using your package manager or directly from the [website](https://downloads.mariadb.com/Connectors/java/connector-java-2.7.3/)
- `keytool` for generating TLS certificate
- `Web sever` - tested with `apache` and `nginx`
- `make`

## Installation 

Install all the required dependencies and run this command to link the mariadb-jdbc connection to your java runtime.
```
# ln -s /usr/share/java/mariadb-jdbc/mariadb-java-client.jar /usr/lib/jvm/default-runtime/jre/lib/ext
```
If you downloaded the `mariadb-jdbc` connecter manually place it into this directory first.
```
/usr/share/java/mariadb-jdbc/mysql-connector-java-bin-2.7.3.jar
```

Git clone the repository and run the make command.
```
$ git clone https://github.com/skafdan/ChatServer

$ cd /path/to/ChatServer

$ make
```

## Usage
Run the installation script `startServer.sh` as root.
```
/path/to/ChatServer/ # ./startServer.sh
```
It can also be run with an optional port number, however it will use the port `7777`  if not provided.

```
/path/to/ChatServer/ # ./startServer.sh [port]
```

The script generates the TLS certificate and copies it the to default root of the 
webserver `/var/www/html/` to be downloaded by the client when they connect.

### data.properties
The authentication and address for the database are imported using java properties library, as such
a `data.properties` file with 3 key-value pairs needs to be in the root directory of the project
```
host=jdbc::mysql://<address>/chatserver
username=<username>
password=<password>
```

## Database setup


The database requires two tables;
- `user` - A table for users of the database
    - Columns:
        - username: Unique name of the user (Primary-Key)
        - passwd: sha256 hashed password+salt
        - salt: created at time of user creation
- `message` - A table containing log of messages sent
    - Columns:
        - timestamp: uses `now()` function to timestamp messages
        - message_id: auto-incrementing id of the message (Primary-key)
        - message_user_id: sender of message also (Foreign-Key to `user` table)
        - message_content: the message content
