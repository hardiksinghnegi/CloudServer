import paramiko
import sys
import socket


ipAddress = sys.argv[1]
userName = sys.argv[2]
authToken = sys.argv[3]
authType = sys.argv[4]
port = int(sys.argv[5])



if authType == '1':
	try:
		ssh=paramiko.SSHClient()
		ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
		ssh.connect(ipAddress,port,userName,authToken)
		print "True"
	except (paramiko.AuthenticationException, paramiko.SSHException, socket.error) as se:
		print se
else:
	try:
		ssh=paramiko.SSHClient()
		ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
		ssh.connect(ipAddress,port,userName,key_filename=authToken)
		print "True"
	except (paramiko.AuthenticationException, paramiko.SSHException, socket.error) as se:
		print se
