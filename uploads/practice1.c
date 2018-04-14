#include<stdio.h>
int
main ()
{
  int a[] = { 1, 2, 3, 4, 5 };
  int *p = a;
  printf ("%d", *p);
  ++(*p);
  p += 2;
  printf ("%d", *p);
}
