# txtr-server

Test server for TXTR. Includes prosody and ejabberd config files and some required modules.

### Prosody

##### Client-Server
1. XEP-0163: PEP (Avatars) -> **OK**
2. XEP-0198: Stream Management -> **OK**
3. XEP-0280: Message Carbons -> **OK**
4. Compression (zLib) -> **OK**
5. TLS/SSL -> **OK** (self-signed for testing)

##### Server Only
1. zLib -> **OK**
2. LuaSec 0.5 -> **OK**
3. LuaDBI *(lua-dbi-mysql)* -> **OK**
4. MySQL -> **OK DB** *(prosody / mysql integration pending)*

### ejabberd
* Basic config
