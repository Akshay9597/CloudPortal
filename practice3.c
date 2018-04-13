#include<stdio.h>
#include<fcntl.h>
int main(int argc, char *argv[]) {
	char *p;
	int i;
	printf("arg count : %d\n", argc);
	for(i = 0;i < argc; i++)
		printf("argv[%d]: %s\n", i, argv[i]);
	return 0;
}
