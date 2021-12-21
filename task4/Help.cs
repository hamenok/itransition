using System;
using System.Collections.Generic;
using System.Text;

namespace Help
{
    class Help
    {
        public Help(){}
        public void genMap(string[] help)
        {
            string[,] table = new string[help.Length + 1, help.Length + 1];
            table[0, 0] = "you\\pc";
            for (int i = 0; i < help.Length; i++)
            {
                table[i+1, 0] = help[i];
            }

            for (int j = 0; j < help.Length; j++)
            {
                table[0, j+1] = help[j];
            }

            int halfLength = Convert.ToInt32(Math.Floor(Convert.ToDouble(help.Length) / 2));

            for (int i=1; i<help.Length+1; i++)
            {
                for (int j=1; j<help.Length+1; j++)
                {
                    if (i == j)
                    {
                        table[i, j] = "Draw";
                    } 
                    else if (i < j && (j - i) <= halfLength)
                    {
                        table[i, j] = "Win";
                    }                    
                    else if (i+halfLength >= help.Length && i>j+halfLength)
                    {
                        table[i, j] = "Win"; 
                    } 
                    else
                    {
                        table[i, j] = "Lose";
                    }
                }
            }
            for (int i = 0; i < help.Length+1; i++)
            {
                Console.WriteLine();
                for (int j = 0; j < help.Length+1; j++)
                {
                    Console.Write(table[i, j] + "\t");
                }
            }
            Console.WriteLine("\n");
        }
    }
}
