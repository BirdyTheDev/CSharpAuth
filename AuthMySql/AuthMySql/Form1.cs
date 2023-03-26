using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Management;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Runtime.InteropServices;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;
using System.Reflection;
using System.Diagnostics;

namespace AuthMySql
{
    public partial class Form1 : Form
    {
        string version = "0.1";
        public Form1()
        {
            InitializeComponent();
        }
        [DllImport("kernel32.dll", SetLastError = true, CharSet = CharSet.Auto)]
        [return: MarshalAs(UnmanagedType.Bool)]
        static extern bool GetVolumeInformation(string lpRootPathName, IntPtr lpVolumeNameBuffer, int nVolumeNameSize, out uint lpVolumeSerialNumber, out uint lpMaximumComponentLength, out uint lpFileSystemFlags, IntPtr lpFileSystemNameBuffer, int nFileSystemNameSize);

        // HDD serisini almak için bir yöntem oluþturun.
        public static string GetHddSerial()
        {
            uint serial = 0;
            uint maxCompLen = 0;
            uint flags = 0;
            if (!GetVolumeInformation("C:\\", IntPtr.Zero, 0, out serial, out maxCompLen, out flags, IntPtr.Zero, 0))
            {
                throw new System.ComponentModel.Win32Exception();
            }
            return serial.ToString("X");
        }

        // HDD serisini alýn ve kullanýn.
        string serial = GetHddSerial();

        private void login_Click(object sender, EventArgs e)
        {
            string url = "http://127.0.0.1/check.php"; // check.php dosyasýnýn URL'si
            string username = usernametxt.Text; // kontrol edilecek kullanýcý adý
            string password = passwordtxt.Text; // kontrol edilecek þifre
            string id = serial;
            WebClient client = new WebClient();
            string response = client.DownloadString($"{url}?id={id}&username={username}&password={password}");
            if (response.Contains("done"))
            {
                WebClient client2 = new WebClient();
                string versionserver = client.DownloadString($"http://127.0.0.1/currentver.html");
                if (version != versionserver)
                {
                    MessageBox.Show("New Version Found Download It From Our Discord!");
                    System.Diagnostics.Process.Start("https://discord.gg/eq59M3rqmf");

                    Application.Exit();

                }
                else
                {
                    MessageBox.Show("U Have Latest Version Starting Application...");
                    this.Hide();

                    //Type Your MainForm Name Here!
                    // MainForm form2 = new MainForm();
                    //  form2.Show();
                }
            }
            else
            {
                MessageBox.Show("Cant Login Please Send Message To Birdy#9999 To Purchase License");
            }
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            string id = serial;
            hdd.Text = id;
        }
    }
}