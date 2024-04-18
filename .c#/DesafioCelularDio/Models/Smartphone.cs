using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace DesafioCelularDio.Models
{
    public abstract class Smartphone
    {
        public string Numero { get; set; }
        protected string Modelo { get; set; }

        protected string IMEI { get; set; }
        protected int Memoria{ get; set; }

        public Smartphone (string numero, string modelo, string imei,int memoria){
            Numero = numero;
            Modelo = modelo;
            IMEI = imei;
            Memoria = memoria;
            
        }

        public void Ligar(){
            Console.WriteLine("Ligando...");

        }

        public void ReceberLigacao(){
            Console.WriteLine("Recebendo Ligação...");
        }

        public abstract void InstalarAplicativo(string aplicativo);


    }
}