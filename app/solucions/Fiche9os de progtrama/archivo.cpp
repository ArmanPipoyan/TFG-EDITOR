#include <iostream>
#include <fstream>
using namespace std;
int main(){
    char data[100];
    // creating the file variable of the fstream data type for writing
    fstreamwfile;
    // opening the file in both read and write mode
    wfile.open ("demo.txt", ios::out| ios::in );
    // Asking the user to enter the content
    cout<< "Please write the content in the file." <<endl;
    // Taking the data using getline() function
    cin.getline(data, 100);
    // Writing the above content in the file named 'demp.txt'
    wfile<< data <<endl;
    // closing the file after writing
    wfile.close();
    //creating new file variable of data type 'ifstream' for reading
    ifstreamrfile;
    // opening the file for reading the content
    rfile.open ("demo.txt", ios::in| ios::out );
    // Reading the content from the file
    rfile>> data;
    cout<< data <<endl;
    //closing the file after reading is done
    rfile.close();
    return 0;
}