/*Read always returns a 0. So p is 0 when file ends.`*/
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>
#include <stdio.h>
#include <string.h>
#include <errno.h>
int main(int argc, char *argv[]) {
	int fd, count, p;
	count = 0;
	char ch;
	fd = open(argv[1], O_RDONLY);
	while((p = read(fd, &ch, sizeof(char)))) {	
		count++;
		printf("%d\n", p);
	}
	printf("%d %d", p, count);
	close(fd);
	return 0;
}
	
