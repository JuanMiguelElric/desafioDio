using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace DesafioCelularDio.Models
{
    public class Iphone : Smartphone
    {
        public Iphone(string numero,string modelo, string imei, int memoria):base(numero,modelo,imei, memoria)
        {
            Console.WriteLine($"O numero do seu iphone é {numero} o modelo é {modelo} o imei é {imei} {memoria} ");

        }
        public override void InstalarAplicativo(string aplicativo)
        {
            Console.WriteLine($"Aplicativo Iphone está sendo instalado {aplicativo}");
        }
        
    }
}