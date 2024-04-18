using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace DesafioCelularDio.Models
{
    public class Nokia : Smartphone
    {
        //public string numero { get; set; }
          public Nokia(string numero, string modelo, string imei, int memoria) : base(numero, modelo, imei, memoria)
        {
            Console.WriteLine("" + numero+""+modelo+""+imei+""+memoria);
        }

        public override void InstalarAplicativo(string aplicativo){
            Console.WriteLine($"Instalando aplicativo {aplicativo}");
        }
    

    }
}