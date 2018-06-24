#include <stdlib.h>
#include <stdio.h>
#include <string.h>
int StrToInt(char* string)
{
    int number=0;
    int islow=0;
    while(*string!=0 && *string!='\n'){

        if(*string=='-') {
            islow=1;
            ++string;
            continue;
        }
        if(*string<=48 || *string >=57) {
            ++string;
            continue;
        }

            number = number * 10 + *string-'0';
        if(number<0){

            printf("溢出!\n");
            return -1;
        }            

            ++string;



    }
    number =  islow ==1 ? number*(-1) :number;
    return number;
}

void main(){
    int result;
    char string[56];
    printf("请输入字符: \n");
    fgets(string,sizeof(string), stdin);
    result=StrToInt(string); 
    printf("转换为整数为:%d\n",result);
}