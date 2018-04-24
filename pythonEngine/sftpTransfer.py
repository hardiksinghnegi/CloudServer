import sys
import pysftp
import paramiko
import socket
import os

cnopts = pysftp.CnOpts()
cnopts.hostkeys = None

funcType = sys.argv[1]
hostName = sys.argv[2]
userName = sys.argv[3]
userAuth = sys.argv[4]
authType = sys.argv[5]
connPort = sys.argv[6]
upPath = sys.argv[7]

sftpObj = None

if authType == '1':
	sftpObj = pysftp.Connection(host = hostName,username = userName,password=userAuth)
else:
	try:
		sftpObj = pysftp.Connection(host = hostName,username = userName,private_key=userAuth,cnopts=cnopts)
	except (paramiko.AuthenticationException, paramiko.SSHException, socket.error) as se:
		print str(se)

if funcType == '1':
	sftpObj.put(upPath)
	print "Uploaded"
elif funcType == '2':
	fileName = sys.argv[8]
	os.chdir(upPath)
	sftpObj.get(fileName)
	print "Downloaded"
else:
	if sftpObj.exists(upPath):
		sftpObj.unlink(upPath)
		print "Deleted"
	else:
		print "Invalid Path"