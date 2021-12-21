using System;

public class Help
{
	public Help()
	{
	}
	public void genMap(string[] help)
    {
		for (int i=0; i<help.Length; i++)
        {
			Console.Write(help[i]);
			for (int j=0; i<help.Length; j++)
            {
				Console.Write(help[j]);
            }
        }
    }
}
