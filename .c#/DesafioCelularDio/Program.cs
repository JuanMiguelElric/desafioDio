namespace HelloWorld;
using DesafioCelularDio.Models;
class Program
{
    static void Main(string[] args)

    {
        Console.WriteLine("Para telefone Nokia");
        Nokia nokia = new Nokia("123456789", "Nokia Modelo X", "123456789012345", 64);
        nokia.Ligar();
        //nokia.InstalarAplicativo();

        Console.WriteLine("PAra Telefone Iphone");
        Iphone iphone = new Iphone("98565644455","dfdsdfsdfsdsdsfdfs ", "7979879797899",54);
        iphone.Ligar();
        
    }
}