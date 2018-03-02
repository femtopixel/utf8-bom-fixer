VERSION ?= 0.1.0
CACHE ?= --no-cache=1
FULLVERSION ?= ${VERSION}
archs = amd64 i386 arm32v7
.PHONY: all build publish latest
all: build publish
	CACHE= make latest
qemu-arm-static:
	cp /usr/bin/qemu-arm-static .
qemu-arm64-static:
	cp /usr/bin/qemu-arm64-static .
build: qemu-arm-static qemu-arm64-static
	$(foreach arch,$(archs), \
		cat Dockerfile | sed -E "s/FROM alpine/FROM $(arch)\/alpine/g" > .build; \
		docker build -t femtopixel/utf8-bom-fixer:${VERSION}-$(arch) ${CACHE} -f .build .;\
	)
publish:
	docker push femtopixel/utf8-bom-fixer
	cat manifest.yml | sed "s/\$$VERSION/${VERSION}/g" > manifest2.yaml
	cat manifest2.yaml | sed "s/\$$FULLVERSION/${FULLVERSION}-debian/g" > manifest.yaml
	manifest-tool push from-spec manifest.yaml
latest: build
	cat manifest.yml | sed "s/\$$VERSION/${VERSION}/g" > manifest2.yaml
	cat manifest2.yaml | sed "s/\$$FULLVERSION/latest/g" > manifest.yaml
	manifest-tool push from-spec manifest.yaml
