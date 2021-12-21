using System;
using System.Collections.Generic;
using System.Text;
using System.Security.Cryptography;


namespace GenKey
{
    class GenKey
    {
        private int KEY_BITS = 256;
        public byte[] gen()
        {
            int keyLength = this.KEY_BITS / 8;
            var bytes = new byte[keyLength];
            using (var random = new RNGCryptoServiceProvider())
            {
                random.GetBytes(bytes);
                return bytes;
            }
        }
    }
}
