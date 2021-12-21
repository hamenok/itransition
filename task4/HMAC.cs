using System;
using System.Collections.Generic;
using System.Text;
using System.Security.Cryptography;

namespace HMAC
{
    class HMAC
    {
        private byte[] key;
        private string game;
        public HMAC(byte[] key, string game)
        {
            this.key = key;
            this.game = game;
        }
        public string genHMAC()
        {
            using (var hmac = new HMACSHA256(key))
            {
                byte[] bstr = Encoding.Default.GetBytes(game);
                var bhash = hmac.ComputeHash(bstr);
                return BitConverter.ToString(bhash).Replace("-", string.Empty).ToLower();
            } 
        } 
    }
}
