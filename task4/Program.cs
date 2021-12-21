using System;
using Help;
using GenKey;
using WhoWin;
using System.Text.RegularExpressions;
using System.Linq;

namespace task4
{
    class Game
    {
        public string name;
        public string variant;

        public Game(){}
        public Game(string name, string variant)
        {
            this.name = name;
            this.variant = variant;
        }

        public int getRand(int max)
        {
            Random rnd = new Random();
            return rnd.Next(1, max);
        }
    }

    
    class Program
    {
        public static void consoleWrite(string text)
        {
            Console.WriteLine(text);
        }
        public static void getMenu(string[] action)
        {
            consoleWrite("Available moves: ");

            for (int i = 0; i < action.Length; i++)
            {
                consoleWrite($"{i+1} - {action[i]}");
            }
            consoleWrite("0 - Exit");
            consoleWrite("? - Help");
        }
        public static string answer;
        public static string answerHelp;
        public static void Menu(string[] args)
        {
            ConsoleKeyInfo keys;
            var rule = @"[0-" + args.Length + "]";
            var buf = "";

            while (true)
            {
                keys = Console.ReadKey(true);
                if (keys.Key == ConsoleKey.Escape)
                    break;

                if (Regex.IsMatch(keys.KeyChar.ToString(), rule))
                {
                    buf += keys.KeyChar;
                    Console.WriteLine(buf);
                    answer = buf;
                    break;

                }
                if (keys.KeyChar == '?')
                {
                    buf += keys.KeyChar;
                    Console.WriteLine(buf);
                    answerHelp = buf;
                    buf = "";
                    break;
                }
            }
        }
        static void Main(string[] args)
        {

            bool allUnique = args.Distinct().Count() == args.Length;
            if (args.Length < 3 || (args.Length % 2) == 0)
            {
                consoleWrite("Wrong number of arguments. There must be more than two arguments and an odd number");
            } else if (!allUnique)
            {
                consoleWrite("Items must be unique");
            }
            else
            {
                var pc = new Game();
                pc.name = "Computer";
                pc.variant = Convert.ToString(pc.getRand(args.Length));
                var key = new GenKey.GenKey().gen();
                
                var hm = new HMAC.HMAC(key, pc.variant);
                var hmac = hm.genHMAC();
                consoleWrite("HMAC: \n"+hmac);
                getMenu(args);
                Console.Write("Enter your move: ");
                Menu(args);
        

                if (answer=="0")
                {
                    Environment.Exit(0);
                }
                if (answerHelp == "?")
                {
                    var help = new Help.Help();
                    help.genMap(args);
                    getMenu(args);
                    Console.Write("Enter your move: ");
                    Menu(args);
                    var user = new Game("Your", answer);
                    consoleWrite(user.name + " selected variant: " + args[Convert.ToInt32(user.variant) - 1]);
                    consoleWrite(pc.name + " selected variant: " + args[Convert.ToInt32(pc.variant) - 1]);
                    var win = new WhoWin.WhoWin();
                    
                    consoleWrite("You "+ win.getWin(args, args[Convert.ToInt32(user.variant) - 1], args[Convert.ToInt32(pc.variant) - 1]) + "!");
                    consoleWrite("HMAC key:\n" + BitConverter.ToString(key).Replace("-", string.Empty).ToLower());
                } 
                else
                {
          
                    var user = new Game("Your", answer);
                    consoleWrite(user.name + " selected variant: " + args[Convert.ToInt32(user.variant) - 1]);
                    consoleWrite(pc.name + " selected variant: " + args[Convert.ToInt32(pc.variant) - 1]);
                    var win = new WhoWin.WhoWin();

                    consoleWrite("You " + win.getWin(args, args[Convert.ToInt32(user.variant) - 1], args[Convert.ToInt32(pc.variant) - 1]) + "!");
                    consoleWrite("HMAC key:\n"+BitConverter.ToString(key).Replace("-", string.Empty).ToLower());
                }
            }  
        }
    }
}
