import os
import errno
import socket
import time
import subprocess
#from socket import socket
#import socket.error as socket_error
PORT = 8080
HOST = '192.168.1.2'
clients = 1
client_name = 0
#ANSI_BACKGROUND = '\033[44m'
#ANSI_RED = '\033[31m'
#ANSI_BLUE = '\033[34m'
#ESCAPEANSI = '\033[0m'
print ('Welcome to the Data Transfer application')
#nombrearchivo = raw_input('define a name with its extension').strip(' ')
recieve_file = 'filename.txt'

#soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#soc.connect((HOST, PORT))


#while True:
#    try:
#        soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#        soc.connect((HOST, PORT))
#    except socket.error:
#        #if serr.errno != errno.ECONNREFUSED:
#        #    raise serr
#        print ("helo")
#        print ('try again')
#        exit(1)
#        


def file_len(fatname):
    counters = 0
    with open(fatname) as fat:
        for counters, l in enumerate(fat):
            pass
        return counters + 1

#filename = soc.recv(1024)
#print (filename)
#fname = open('./asd.pdf', 'wb')


database_ptr = open('clouddml.sql', 'ab')
while True :

    while True :
        try :
            soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            soc.connect((HOST, PORT))
            break
        except socket.error:
            continue;
    recieve_file == 'filename.txt'
    filename_rec = open(recieve_file, 'wb')
    print ("inside loop")
    
    #filename = soc.recv(128)
    while True:
        strng = soc.recv(1024)
        if strng:
            filename_rec.write(strng)
        else:
            filename_rec.close()
            break
    recieve_file = 'next'
    #filename_ptr = open('filename.txt', 'r')
    #print filename_ptr.read()
    filename_rec.close()
    print ("rec filename.txt")
    filename_ptr = open('filename.txt', 'r')
    print filename_ptr.read()
    filename_ptr.close()
    print ("exit loop1")
    #exit(1)
    
    soc.close()
    


    print ("inide loop #2")
    file_length = file_len('filename.txt')
    print (file_length)
    
    filename_ptr = open('filename.txt', 'r')
    line_count = 0
    
    
    #print filename_ptr.read()
    for line in filename_ptr:
        user, recieve_file = line.split("#")
        #print user, "hello", recieve_file
        #break
        print (recieve_file)
        if line_count == (file_length - 1) :
            recieve_file = recieve_file.strip()
        else :
            recieve_file, trash = recieve_file.split("\n")
    
        print (recieve_file)

        hash_val = hash(recieve_file)
        client_id = (hash_val % clients)

        if client_id != client_name:
            continue
        
        soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        soc.connect((HOST, PORT))
    
        fname = open('./'+recieve_file, 'wb')
    
        while True:
            strng = soc.recv(1024)
            if strng:
                fname.write(strng)
            else:
                #pass 
                fname.close()
                break
        line_count = line_count + 1
        database_ptr.write("insert into data values (\"%s\", \"%s\");\n"%(user,
            recieve_file))
    
        soc.close()
    print (line_count)
    subprocess.call("./sql_script.sh", shell=True)
    recieve_file = 'filename.txt'
    os.remove(recieve_file)
    #break
    














#while 1 :
#    if recieve_file == 'filename.txt' :
#        filename_rec = open(recieve_file, 'wb')
#        print ("inside loop")
#
#        #filename = soc.recv(128)
#        while True:
#            strng = soc.recv(18)
#            if strng:
#                filename_rec.write(strng)
#            else:
#                filename_rec.close()
#                break
#        recieve_file = 'next'
#        #filename_ptr = open('filename.txt', 'r')
#        #print filename_ptr.read()
#        filename_rec.close()
#        print ("rec filename.txt")
#        filename_ptr = open('filename.txt', 'r')
#        print filename_ptr.read()
#        filename_ptr.close()
#        print ("exit loop1")
#        #exit(1)
#
#    else :
#        print ("inide loop #2")
#        file_length = file_len('filename.txt')
#        print (file_length)
#
#        filename_ptr = open('filename.txt', 'r')
#        line_count = 0
#        #print filename_ptr.read()
#        for line in filename_ptr:
#            user, recieve_file = line.split("#")
#            #print user, "hello", recieve_file
#            #break
#            print (recieve_file)
#            if line_count == (file_length - 1) :
#                recieve_file = recieve_file.strip()
#            else :
#                recieve_file, trash = recieve_file.split("\n")
#
#            print (recieve_file)
#            
#
#            fname = open('./'+recieve_file, 'wb')
#
#            while True:
#                strng = soc.recv(10)
#                if strng:
#                    fname.write(strng)
#                else:
#                    fname.close()
#                    break
#            line_count = line_count + 1
#        print (line_count)
#        recieve_file = 'filename.txt'
#        break
#    
#
#

        





#fname = open('./'+recieve_file, 'wb')
#
#while True:
#	strng = socket.recv(1024)
#	if strng:
#		fname.write(strng)
#	else:
#		fname.close()
#		break
soc.close()
#print ESCAPEANSI
print ('Data received correctly')
#print ESCAPENSI
exit()
