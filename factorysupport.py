#!/usr/bin/python3
import requests
import mysql.connector
import pymysql
import json
from urllib.parse import urlencode
import time
import rsa
from apscheduler.schedulers.background import BackgroundScheduler
from base64 import b64encode
import urllib.parse
from base64 import b64decode
from mysql.connector.errors import Error
import MySQLdb as my
# open databse connection
try:
   db = pymysql.connect("localhost","root","1234567","rrsecmain")
 
# create cursor object
   cursor = db.cursor()
except my.Error as e:
   try:
         sqlError="Error %d%s"%(e.args[0],e.args[1])
   except IndexError:
         print("MySQL Error:%s"%str(e))

         exit()

except pymysql.err.DatabaseError as e:
         print("Error %d%s"%(e.args[0],e.args[1]))

         exit()
       
   
get_num=10000
post_num=10000
#t=time.time() 


'''
This function will generate the token for client
'''
def generateToken():
     
# store private key

# input private key
     with open('public.pem','r') as f:
       pubkey = rsa.PublicKey.load_pkcs1(f.read().encode())    
# 
#newt=[t,'hello']
#json_encode=json.dumps(newt)
     message='hello,%d'%(time.time())



# encrypt public key 
     crypto = rsa.encrypt(message.encode('utf-8'), pubkey)
     enmsg=b64encode(crypto)
     #print("BEFORE quote",enmsg)
    
  
     return enmsg
 

'''
This function will pass the parameters as $GET to my_get_api's url
then get the result of selected json_encode data
process the data decode them and insert into factorydb
'''
#test for getAPI takes about 20sec
#get the data from center"rrsecmiio" then insert into factory "rrsectb"
def testgetAPI():
    print("[*GET*]rrsectb begins at: ", time.asctime( time.localtime(time.time())))
    url11="http://localhost/testapi/my_get_api.php"
    token = generateToken()
    try:
       r=requests.get(url=url11, params={'action': 'get_center_info', 'num':get_num, 'token': token})
    except pymysql.err.InterfaceError as e:
       print("Error: %d %s "%(e.args[0],e.args[1]))
       exit()



    
    #r.json() this will transfer into python object
    #r.text this is a str object
    #print (r.url)#print out the url 
   
    #this json function transfer the json data into a python list
    #then use the length(amount of data that needed to be inserted) to control the loop    
    #pythonlist=r.json()
    pythonlist=r.json()
    code=int(pythonlist[0]['code'])
    if(code>0):
        print(pythonlist[0]['msg'])
        exit()
    print(pythonlist[0]['msg'])
    pythonlist=pythonlist[0]['data']
    #new=newlist.json()
 
  
    for i in range(len(pythonlist)):
       sql="INSERT ignore INTO rrsectb(miiodid,miiokey,miiomac) VALUES ('%s','%s','%s')" %(pythonlist[i]['miiodid'],pythonlist[i]['miiokey'],pythonlist[i]['miiomac'])
     
       try:
   # 执行sql语句
         cursor.execute(sql)
 
         db.commit()
       except:
         print("failed to insert the %d data!" %(i+1))
    print("[*GET*]rrsectb has been successfully inserted at: ", time.asctime( time.localtime(time.time())))
    print(" ")

  
      
      
'''
This function will test my_post_api using the $POST method
return the selected  encode_json data and the amount of total selected data to the main function
'''
#post api takes about 20sec without the update query in factoryside
def testpostAPI():
     print("[*POST*]rrsectb begins to updated at: ", time.asctime( time.localtime(time.time()) ))
     #handle the first table in factory: rrsectb then insert into the center"rrsecbk"
     sql="SELECT * FROM rrsectb WHERE IN_USE=0 and COMPLETE=1 order by uid LIMIT %d" % (post_num)
     sql1="UPDATE rrsectb SET IN_USE=1 WHERE IN_USE=0 and COMPLETE=1 order by uid LIMIT %d" % (post_num)
     try:
        cursor.execute(sql)
        results=cursor.fetchall()
        #every row is a tuplet
        smalllist=[]
      
        for row in results:
            dict={}
            dict['uid']=row[0]
            dict['miiodid']=row[1]
            dict['miiokey']=row[2]
            dict['miiomac']=row[3]
            dict['miiosn']=row[4]
            dict['cpusn']=row[5] 
            dict['mcuid']=row[6]  
            dict['emcuid']=row[7]  
            dict['ecpuid']=row[8]  
            dict['dkey']=row[9]  
            dict['checksum']=row[10]      
            dict['clientinfo']=row[11] 
            dict['date']=row[12] 
            dict['appassword']=row[13]
            dict['prodtype']=row[14]
            dict['devtype']=row[15]
            dict['IN_USE']=row[16]
            dict['COMPLETE']=row[17] 

            smalllist.append(dict)
        
        db.commit()
   
     except:
        print("Unable to update table rrsectb")
        cursor.close()
        db.close()
        exit()

     tblist=json.dumps(smalllist)
     # print(tblist)
     # exit()
     
     #json dunpms transfer dict into str
     #json loads transfer str into dict
     #set the token and use it as a dictionary's value
     table='table1'
     
     token=str(generateToken(),'utf-8')
    

     data = {'enjson': tblist, 'amount_of_trans': len(smalllist), 'token':token,'table':table}
     try:
        url='http://localhost/testapi/my_post_api.php'
        headers={"Content-Type":"application/json"}
        res=requests.post(url=url,json=data,headers=headers)
     except pymysql.err.MySQLError as e:
        print("Error of post table1: %d %s "%(e.args[0],e.args[1]))
        db.close()
        cursor.close()
        exit()
     except:
        print("Another error occured during rrsectb post")
        db.close()
        cursor.close()
        exit()

     pythonlist=res.json()
     print(pythonlist[0]['msg'])
     print("[*POST*]rrsectb has been successfully updated at: ", time.asctime( time.localtime(time.time()) ))
     print(" ")

#*******************************************************************************************************   
     manualupdate="UPDATE rrsecdevinfo set isbackup=0 where isbackup=1;"
     try:
        cursor.execute(manualupdate)
        db.commit()
     except:
        print("Fialed to manually update")
        exit()

     print("[*POST*]rrsecdevinfo begins to updated at: ", time.asctime( time.localtime(time.time()) ))
     #handle the second table"rrsecdevinfo" in factory then insert into center "rrsecdevinfo"
     sql2="SELECT * FROM rrsecdevinfo WHERE isbackup=0 ORDER BY uid LIMIT %d" % (post_num)
     sql3="UPDATE rrsecdevinfo SET isbackup=1 WHERE isbackup=0 ORDER BY uid LIMIT %d" % (post_num)
     try:
        cursor.execute(sql2)
        results2=cursor.fetchall()
        #every row is a tuplet
        infolist=[]
     
        for row in results2:
            dict={}
            dict['uid']=row[0]
            dict['miiosn']=row[1]
            #dict['lastaccessdate']=row[2]
            dict['isbackup']=row[3]
            dict['macaddr']=row[4]
            dict['bootloaderver']=row[5] 
            dict['kernelver']=row[6]  
            dict['kernelbuildtime']=row[7]  
            dict['emmc']=row[8]  
            dict['ddr']=row[9]  
            dict['compassid']=row[10]      
            dict['apver']=row[11] 
            dict['ldsver']=row[12] 
            dict['ldsid']=row[13]
            dict['mcuver']=row[14]
            dict['testinfo']=row[15]
            dict['pn']=row[16]
            dict['rtc']=row[17] 
            dict['mcuid']=row[18]
            dict['batid']=row[19]
            dict['gyroid']=row[20]
            dict['chargerid']=row[21]
            dict['acccal']=row[22]
            dict['gyrocal']=row[23]
            dict['wallsensorcal']=row[24]
            dict['cliffcal1']=row[25]
            dict['cliffcal2']=row[26]
            dict['cliffcal3']=row[27]
            dict['cliffcal4']=row[28]
            dict['cliffcal5']=row[29]
            dict['cliffcal6']=row[30]
            dict['WallsensorID']=row[31]
            dict['Compass2ID']=row[32]
            dict['Camera0ID']=row[33]
            dict['Camera1ID']=row[34]
            dict['infofilelength']=row[35]
          

            infolist.append(dict)
        cursor.execute(sql3)
        db.commit()
       
     except:
        print("Unable to update rrsecdevinfo")
        cursor.close()
        db.close()
        exit()

     devinfofinallist=json.dumps(infolist)
     table='table2'
     token2=str(generateToken(),'utf-8')
     
     #json dunpms transfer dict into str
     #json loads transfer str into dict
     #set the token and use it as a dictionary's value
     data2 = {'enjson': devinfofinallist, 'amount_of_trans': len(infolist),'token': token2 ,'table':table}
     url='http://localhost/testapi/my_post_api.php'
     headers={"Content-Type":"application/json"}
     try:
        res=requests.post(url=url,json=data2,headers=headers)
     except pymysql.err.InterfaceError as e:
        print("Error of post table2: %d %s "%(e.args[0],e.args[1]))
        cursor.close()
        db.close()
        exit()
     except:
        print("Another error occured during rrsecdevinfo post")
        cursor.close()
        db.close()
        exit()
     pythonlist=res.json()
     print(pythonlist[0]['msg'])
     print("[*POST*]rrsecdevinfo has been successfully updated at: ", time.asctime( time.localtime(time.time()) ))
     print(" ")

#schedule will block the job single thread
#main function will call the above functions
#backgroundscheduler won't block the current thread
scheduler = BackgroundScheduler()
scheduler.add_job(testpostAPI, 'interval', minutes=30)
scheduler.start()
#testpostAPI()

#generateToken()
