
class Hash
  def slice(*keep_keys)
    h = {}
    keep_keys.each { |key| h[key] = fetch(key) if has_key?(key) }
    h
  end unless Hash.method_defined?(:slice)
  def except(*less_keys)
    slice(*keys - less_keys)
  end unless Hash.method_defined?(:except)
end

Vagrant.configure("2") do |config|
  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|
    aws.access_key_id = ENV['AWS_ACCESS_KEY_ID']
    aws.secret_access_key = ENV['AWS_SECRET_ACCESS_KEY']
    aws.session_token = ENV['AWS_SESSION_TOKEN']
    aws.keypair_name = "cosc349-lab"

    aws.ami = "ami-09e67e426f25ce0d7"
    aws.instance_type = "t2.micro" 
    aws.security_groups = "chatserver"
    override.ssh.username = "ubuntu"
    override.ssh.private_key_path = "~/.ssh/cosc349-lab.pem"

  end
end
