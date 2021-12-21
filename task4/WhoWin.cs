using System;
using System.Collections.Generic;
using System.Text;

namespace WhoWin
{
    class WhoWin
    {
        public WhoWin() { }
        public string getWin(string[] help, string usr, string pc)
        {
            string[,] table = new string[help.Length + 1, help.Length + 1];
  
            for (int i = 0; i < help.Length; i++)
            {
                table[i + 1, 0] = help[i];
            }

            for (int j = 0; j < help.Length; j++)
            {
                table[0, j + 1] = help[j];
            }

            int halfLength = Convert.ToInt32(Math.Floor(Convert.ToDouble(help.Length) / 2));

            for (int i = 1; i < help.Length + 1; i++)
            {
                for (int j = 1; j < help.Length + 1; j++)
                {
                    if (i == j)
                    {
                        table[i, j] = "Draw";
                    }
                    else if (i < j && (j - i) <= halfLength)
                    {
                        table[i, j] = "Win";
                    }
                    else if (i + halfLength >= help.Length && i > j + halfLength)
                    {
                        table[i, j] = "Win";
                    }
                    else
                    {
                        table[i, j] = "Lose";
                    }
                }
            }
            int row = 0;
            for (int i = 0; i < help.Length + 1; i++)
            {
                if (table[i, 0]==usr)
                {
                    row = i;
                }
                
            }
            int column = 0;
            for (int j = 0; j < help.Length + 1; j++)
            {
               if (table[0, j] == pc)
                {
                    column = j;
                }
            }
            return table[row,column];
        }
    }
}
