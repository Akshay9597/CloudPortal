import time
import os
import socket
PORT = [8080,9090]
HOST = '192.168.1.10'
clients = 2





#soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#soc.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
#
#soc.bind((HOST,PORT))
#soc.listen(1)
#conn, addr = soc.accept()

while 1 :
    #delay 
    time.sleep(10)

    for i in range(0, clients):
        
        
        #send_file = 'filename.txt'
        #conn.send(send_file)
	#send_file_ptr = open('filename.txt', 'rb')
        while True:
		try: 
			send_file_ptr = open('filename.txt', 'rb')
			soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
			soc.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)

			soc.bind((HOST,PORT[i]))
			soc.listen(1)
			conn, addr = soc.accept()

			break
		except IOError:
			continue

        while True:
            data = send_file_ptr.readline()
            #print data
            if data:
                conn.send(data)
            else :
                break
        send_file_ptr.close()
        conn.close()
    #`file_ptr = open('filename.txt', 'r')
    #print file_ptr.read()
    #exit(1)
    #time.sleep(2)
    file_ptr = open('filename.txt', 'r')
    #print file_ptr.read()
    for line in file_ptr:
        #print (line)
        user, filenames = line.split("#")
        filenames, trash = filenames.split("\n")
        soc = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        soc.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)

        hash_val = hash(filenames)
        client_id = (hash_val % clients)


        
        soc.bind((HOST,PORT[client_id]))
        soc.listen(1)
        conn, addr = soc.accept()
        
        #print user, "hello" , filenames
        #break
        send_file = filenames
        #print (send_file)
        #conn.send(send_file)
        filenames_ptr = open(send_file, 'rb')
        while True:
            data = filenames_ptr.readline()
            #print data
            if data:
                conn.send(data)
            else :
                break
        filenames_ptr.close()
        conn.close()
        os.remove(filenames)
        
    os.remove('filename.txt')
    
    



        

        

    

    

#filesDir(PATH)
#fileSelected = int(raw_input('Select a file with the number').strip(' ').lower()) 
#print PATH + filesDir(PATH)[fileSelected-1]
#
#filepath = PATH +  '/' + 'block.jpg' 
#print filepath
##envia nombre del file
#conn.send(filepath)
#qLines = len(open(PATH + '/' + 'block.jpg', 'rb').readlines())
#
#fileToSend = open(filepath, 'rb')
#while True:
#	data = fileToSend.readline()
#	if data:
#		conn.send(data)
#	else:
#		break
#send_file_ptr.close()
#file_ptr.close()
#conn.sendall('')
#conn.close()
print ('43m File sent')
#Finaliza el programa y deja los codigos ANSI cerrados
exit()
