# txtr-server

**Server side for TXTR XMPP service**

Includes 3 layers:

1. TXTR server
2. MySQL database engine
2. ejabberd XMPP server

## Overview
![screenshots](https://raw.githubusercontent.com/juanignaciomolina/txtr-server/master/TXTR-LayersDiagram.png)

## TXTR Server

###### General

* pinRequest: Generate new unique PIN
* pinRegister: Register a given PIN in the DB
* pinDismiss: Delete a given PIN and all its related data from the DB

###### API

* api: JSON/HTML REST API with numerous methods for working with PINs
* URL: api.droidko.com/?arg=value

###### Config

* mysqlconfig: MySQL txtrCore user configuration
* opendbprosody: Open connection to 'prosody' database (Prosody XMPP Server table)
* closedbprosody: Close connection to 'prosody' database
* hostconfig: Virtual host configuration file

###### Utils

* pintools: Useful tools to manage and generate PINs
* gentools: General use functions for using server-wide
* jsontools: Library for JSON objects encode and management

###### Tests
* pinTest: Automatic tests for PINs methods

## Prosody XMPP Server

##### Client-Server
1. XEP-0163: PEP (Avatars) -> **OK**
2. XEP-0198: Stream Management -> **OK**
3. XEP-0280: Message Carbons -> **OK**
4. ~~Compression (zLib) [INFO](http://prosody.im/doc/modules/mod_compression) -> **OK**~~
5. TLS/SSL -> **OK** (self-signed for testing)

##### Server Only
1. ~~zLib [INFO](http://prosody.im/doc/depends) -> **OK**~~
2. ~~LuaSec 0.5 [INFO](http://prosody.im/doc/depends) -> **OK**~~
3. ~~LuaDBI *(lua-dbi-mysql)* [INFO](http://prosody.im/doc/depends) -> **OK**~~
4. ~~MySQL [INFO](http://prosody.im/doc/storage) -> **OK**~~
5. ~~LuaEvent [INFO](http://prosody.im/doc/depends) -> **OK**~~

## Releases

***(dd/mm/aaaa)***

* v0.1.0: 07/11/2014
* v0.2.0: 23/11/2014pr

## Additional notes

* mysqld.sock [FIX INFO](http://stackoverflow.com/questions/11990708/error-cant-connect-to-local-mysql-server-through-socket-var-run-mysqld-mysq)
* Unable to connect to MySQL from ejabberd. Check network access to db (even from localhost!). This is because XAMPP security can block access to MySQL through TCP/IP, allowing access only through Unix sockets. However, ejabberd uses the TCP/IP protocol (not unix sockets) to connect to an external storage. To solve this, comment the line "skip-networking" in my.cnf (MySQL config file) in opt/lampp/etc
[ALTERNATIVE FIX INFO](http://rclermont.blogspot.com.ar/2008/05/configuring-mysql-for-network-access.html)
