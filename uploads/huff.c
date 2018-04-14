#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdlib.h>
 
#define MAX_TREE_HT 100
 
// A Huffman tree node
struct MinHeapNode {
 
    char data;  // One of the input characters
    unsigned freq;  // One of the input characters
    struct MinHeapNode *left, *right;     // Left and right child of this node
};
 
// A Min Heap:  Collection of min heap (or Hufmman tree) nodes
struct MinHeap {
 
    unsigned size;  // Current size of min heap
    unsigned capacity;   // capacity of min heap
    struct MinHeapNode** array;  // Array of minheap node pointers
};
 
// A utility function allocate a new min heap node with given character and frequency of the character
struct MinHeapNode* newNode(char data, unsigned freq) {
    struct MinHeapNode* temp  = (struct MinHeapNode*)malloc(sizeof(struct MinHeapNode));
    temp->left = temp->right = NULL;
    temp->data = data;
    temp->freq = freq;
    return temp;
}
 
// A utility function to create a min heap of given capacity
struct MinHeap* createMinHeap(unsigned capacity) {
 
    struct MinHeap* minHeap  = (struct MinHeap*)malloc(sizeof(struct MinHeap));
    minHeap->size = 0;  // current size is 0
    minHeap->capacity = capacity; 
    minHeap->array = (struct MinHeapNode**)malloc(minHeap->capacity * sizeof(struct MinHeapNode*));
    return minHeap;
}
 
// A utility function to swap two min heap nodes
void swapMinHeapNode(struct MinHeapNode** a, struct MinHeapNode** b) { 
    struct MinHeapNode* t = *a;
    *a = *b;
    *b = t;
}
 
// The standard minHeapify function.
void minHeapify(struct MinHeap* minHeap, int idx) {
 
    int smallest = idx;
    int left = 2 * idx + 1;
    int right = 2 * idx + 2; 
    if (left < minHeap->size && minHeap->array[left]->freq < minHeap->array[smallest]->freq)
        smallest = left;
    if (right < minHeap->size && minHeap->array[right]->freq < minHeap->array[smallest]->freq)
        smallest = right;
    if (smallest != idx) {
        swapMinHeapNode(&minHeap->array[smallest],&minHeap->array[idx]);
     	minHeapify(minHeap, smallest);
    }
}
 
// A utility function to check if size of heap is 1 or not
int isSizeOne(struct MinHeap* minHeap) {
    return (minHeap->size == 1);
}
 
// A standard function to extract minimum value node from heap
struct MinHeapNode* extractMin(struct MinHeap* minHeap) {
    struct MinHeapNode* temp = minHeap->array[0];
    minHeap->array[0] = minHeap->array[minHeap->size - 1];
    --minHeap->size;
    minHeapify(minHeap, 0);
    return temp;
}
 
// A utility function to insert a new node to Min Heap
void insertMinHeap(struct MinHeap* minHeap, struct MinHeapNode* minHeapNode) {
    ++minHeap->size;
    int i = minHeap->size - 1;
    while (i && minHeapNode->freq < minHeap->array[(i - 1) / 2]->freq) {
        minHeap->array[i] = minHeap->array[(i - 1) / 2];
        i = (i - 1) / 2;
    }
    minHeap->array[i] = minHeapNode;
}
 
// A standard funvtion to build min heap
void buildMinHeap(struct MinHeap* minHeap) {
 
    int n = minHeap->size - 1;
    int i;
    for (i = (n - 1) / 2; i >= 0; --i)
        minHeapify(minHeap, i);
}
 
// A utility function to print an array of size n
void printArr(int arr[], int n) {
    int i;
    for (i = 0; i < n; ++i)
        printf("%d", arr[i]); 
    printf("\n");
}
 
// Utility function to check if this node is leaf
int isLeaf(struct MinHeapNode* root) {
    return !(root->left) && !(root->right);
}
 
// Creates a min heap of capacity equal to size and inserts all character of data[] in min heap. Initially size of min heap is equal to capacity
struct MinHeap* createAndBuildMinHeap(char data[], int freq[], int size) {
    struct MinHeap* minHeap = createMinHeap(size);
    for (int i = 0; i < size; ++i)
        minHeap->array[i] = newNode(data[i], freq[i]);
    minHeap->size = size;
    buildMinHeap(minHeap);
    return minHeap;
}
 
// The main function that builds Huffman tree
struct MinHeapNode* buildHuffmanTree(char data[], int freq[], int size) {
    struct MinHeapNode *left, *right, *top;
    struct MinHeap* minHeap = createAndBuildMinHeap(data, freq, size); // Step 1: Create a min heap of capacit equal to size.  Initially, there are nodes equal to size.
    while (!isSizeOne(minHeap)) {   // Iterate while size of heap doesn't become 1
        left = extractMin(minHeap); // Step 2: Extract the two minimum freq items from min heap
        right = extractMin(minHeap);
        top = newNode('$', left->freq + right->freq);  // Step 3:  Create a new internal node with frequency equal to the sum of the two nodes frequencies. Make the two extracted node as left and right children of this new node. Add this node to the min heap '$' is a special value for internal nodes, not used 
        top->left = left;
        top->right = right;
        insertMinHeap(minHeap, top);
    }
    return extractMin(minHeap);  // Step 4: The remaining node is the root node and the tree is complete.
}
 
// Prints huffman codes from the root of Huffman Tree. It uses arr[] to store codes
void printCodes(struct MinHeapNode* root, int arr[], int top) {
    if (root->left) { // Assign 0 to left edge and recur
        arr[top] = 0;
        printCodes(root->left, arr, top + 1);
    }
    if (root->right) {  // Assign 1 to right edge and recur
        arr[top] = 1;
        printCodes(root->right, arr, top + 1);
    }
    if (isLeaf(root)) {  // If this is a leaf node, then it contains one of the input characters, print the character and its code from arr[]
        printf("%c: ", root->data);
        printArr(arr, top);
    }
}
 
// The main function that builds a Huffman Tree and print codes by traversing the built Huffman Tree
void HuffmanCodes(char data[], int freq[], int size) {
    struct MinHeapNode* root = buildHuffmanTree(data, freq, size); // Construct Huffman Tree
    int arr[MAX_TREE_HT], top = 0;  
    printCodes(root, arr, top); // Print Huffman codes using the Huffman tree built above
}
 
int main(int argc, char *argv[]) {
   	char str[26], ch, n = 26;
   	int count[26] = {0}, x, i, j, k, temp;
	
	for(i = 0; i < 26 ; i++) 
		count[i] = 0;
	for(i = 0; i < 26; i++) 
		str[i] = i + 'a';

	FILE *fp;
	fp=fopen(argv[1],"r");
	while (fscanf(fp,"%c",&ch)!=EOF) {
		if (ch >= 'a' && ch <= 'z') {
         		x = ch - 'a';
         		count[x]++;
      		}
	}

   	for (i = 0; i < n-1; i++) {
		for (j = 0; j < n-i-1; j++){
        		if (count[j] < count[j+1]) {
				temp = count[j];
				count[j] = count[j+1];
				count[j+1] = temp;
				temp = str[j];
				str[j] = str[j+1];
				str[j+1] = temp;
        		}
     		}
	}
	for(i = 0, n = 0; i < 26; i++) {
		if(count[i] != 0)
			n++;
		else
			break;
	}
    	HuffmanCodes(str, count, n);
 
 
   	return 0;


}
