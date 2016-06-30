#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, char * argv[])
{
	if(argc != 3)
	{
		printf("USAGE ./main <file> <output>\n");
		return EXIT_FAILURE;
	}

	FILE * fp;
	FILE * fw;
	char line[100];

	char * mid;
	char * firstname;
	char * lastname;

	fp = fopen(argv[1], "r");
	fw = fopen(argv[2], "w");

	if(fp == NULL || fw == NULL)
	{
		printf("Could not open files\n");
		return EXIT_FAILURE;
	}

	fprintf(fw, "INSERT INTO crew VALUES\n");

	while(fgets(line, 100, fp) != NULL)
	{

		if(line[0] == '-' || line[0] == '\n' || line[0] == '\0' || line[0] == '\r')
			continue;

		for(int i = 0; i < strlen(line); i++)
		{
			if (line[i] == '\n' || line[i] == '\r')
				line[i] = '\0';
		}

		/* Break string into parts */
		mid = strtok(line, ",");
		firstname = strtok(NULL, ",");
		lastname = strtok(NULL, ",");

		fprintf(fw, "\t(%s, '%s', '%s'),\n", mid, firstname, lastname);
	
	}

	fprintf(fw, ";");

	fclose(fp);
	fclose(fw);

	return EXIT_SUCCESS;

}
