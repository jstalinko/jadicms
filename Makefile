.PHONY: commit push auto

commit:
	@if [ -z "$$(git status --porcelain)" ]; then \
		echo "No changes to commit"; \
	else \
		echo "Generating AI commit message..."; \
		php scripts/ai-commit.php > .ai_commit_msg; \
		if grep -q "NO_CHANGES" .ai_commit_msg; then \
			echo "No diff found"; \
		else \
			echo "Commit message: "; \
			cat .ai_commit_msg; \
			git add .; \
			git commit -m "$$(cat .ai_commit_msg)"; \
		fi \
	fi

push:
	@git push origin main

auto: commit push
