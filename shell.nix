with (import <nixpkgs> {});

mkShell {
	buildInputs = [ php php80Packages.composer php80Extensions.xdebug makeWrapper ];
}

